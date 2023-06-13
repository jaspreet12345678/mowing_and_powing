<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Order;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentsController extends ClientBaseController
{
    public function walletSystem()
    {
        $this->wallet = Wallet::where('user_id',auth()->user()->id)->first();
        return view('client.payments.wallet-system',$this->data);
    }

    public function updateWalletSetting(Request $req)
    {
        if (!$req->auto_refill_amount) return response()->json(['success'=>false,'message'=>'Please choose any amount']);
        $data = $req->except('_token');
        $data['user_id'] = auth()->user()->id;
        Wallet::updateOrCreate(['user_id' => $data['user_id']],$data);
        return response()->json(['success'=>true,'message'=>'Wallet setting updated']);
    }

    public function checkout(Request $req)
    {
        if(!$req->default_card_id){
            $req->validate([
                'auto_refill_amount' => 'required'
            ],[
                'auto_refill_amount.required' => 'Please choose any amount'
            ]);
        }
        $data = $req->except('_token');
        $data['user_id'] = auth()->user()->id;

        if($req->default_card_id){
            Card::whereUserId(auth()->user()->id)->whereIsDefault('1')->update(['is_default'=>'0']);
            Card::find($req->default_card_id)->update(['is_default'=>'1']);
        }else{
            $data['auto_refill'] = isset($data['auto_refill']) ? '1' : '0';
        }

        $this->wallet = Wallet::updateOrCreate(['user_id' => $data['user_id']],$data);
        $this->defaultCard = Card::whereUserId(auth()->user()->id)->whereIsDefault('1')->first();
        $this->cards = Card::whereUserId(auth()->user()->id)->latest()->get();

        return view('client.payments.checkout',$this->data);
    }

    public function howItWorks()
    {
        return view('client.payments.how-it-works');
    }

    public function cards()
    {
        $this->cards = Card::whereUserId(auth()->user()->id)->latest()->get();
        $this->wallet = Wallet::whereUserId(auth()->user()->id)->first();
        return view('client.payments.cards',$this->data);
    }

    public function makeDefaultCard(Request $req,$id)
    {
        try {
            Card::whereUserId(auth()->user()->id)->whereIsDefault('1')->update(['is_default'=>'0']);
            Card::find($id)->update(['is_default'=>'1']);
            return back()->with('success','Card has been set as default');
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
    }

    public function deleteCard(Request $req,$id)
    {
        try {
            $card = Card::find($id);

            $this->stripe->customers->deleteSource(
                auth()->user()->customer_id,
                $card->card_id,
                []
            );

            $card->delete();
            session()->flash('success','Card has been deleted');
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
    }

    public function addCardForm(Request $req)
    {   
        $this->order_id = $req->order_id;
        $this->type = $req->type;
        $this->service = $req->service;
        return view('client.payments.__card-form',$this->data);
    }

    public function addCardIndex()
    {
        return view('client.payments.add-card');
    }

    public function addCard(Request $req)
    {   
        try {
            $validator = Validator::make($req->all(), [
                'card_number' => 'required',
                'exp_month' => 'required',
                'exp_year' => 'required',
                'cvv' => 'required'
            ]);
            if ($validator->fails()) {
                if($req->expectsJson()){
                    return response()->json(['success' => false, 'message' => $validator->errors()]);
                }else{
                    return back()->with('errors',$validator->errors());
                }
            }

            $token = $this->stripe->tokens->create([
                'card' => [
                  'number' => $req->card_number,
                  'exp_month' => $req->exp_month,
                  'exp_year' => $req->exp_year,
                  'cvc' => $req->cvv,
                ],
            ]);

            $card = $this->stripe->customers->createSource(
                auth()->user()->customer_id,
                ['source' => $token->id]
            )->toArray();

            $card['card_id'] = $card['id'];
            $card['user_id'] = auth()->user()->id;
            $card['customer_id'] = auth()->user()->customer_id;
            $card['card_number'] = $req->card_number;
            $card['cvv'] = $req->cvv;
            $card['is_default'] = Card::where('user_id',auth()->user()->id)->where('is_default','1')->first() ? '0' : '1';

            Card::create($card);

            if($req->expectsJson()){
                $this->order = Order::find($req->order_id);
                $this->type = $req->type;
                return view('client.'.$req->service.'.__summary',$this->data);
            }else{
                return redirect(route('payments.cards'))->with('success','Card has been added');
            }

        } catch (\Throwable $th) {
            if($req->expectsJson()){
                return response()->json(['success' => false, 'message' => $th->getMessage()]);
            }else{
                return back()->with('error',$th->getMessage());
            }
        }
    }

    public function purchase(Request $req)
    {
        try {
            $req->validate([
                'card_id' => 'required',
            ],['card_id.required' => 'Kindly choose payment method']);

            $this->stripe->charges->create([
                'amount' => $req->auto_refill_amount * 100,
                'currency' => 'usd',
                'customer' => auth()->user()->customer_id,
                'source' => $req->card_id,
                'description' => auth()->user()->first_name.' '.auth()->user()->last_name.' recharged their wallet',
            ]);

            Wallet::whereUserId(auth()->user()->id)->first()->increment('amount',$req->auto_refill_amount);

            return redirect(route('payments.wallet-system'))->with('success','Wallet amount has been updated');

        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
    }
}
