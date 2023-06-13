<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentsController extends ApiBaseController
{
    public function addCard(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'card_number' => 'required',
                'exp_month' => 'required',
                'exp_year' => 'required',
                'cvv' => 'required'
            ]);
            if ($validator->fails()) {
                return parent::resp(false, 'Validation errors', null, $validator->errors());
            }

            $token = $this->stripe->tokens->create([
                'card' => [
                    'number' => $request->card_number,
                    'exp_month' => $request->exp_month,
                    'exp_year' => $request->exp_year,
                    'cvc' => $request->cvv,
                ],
            ]);

            $card = $this->stripe->customers->createSource(
                auth()->user()->customer_id,
                ['source' => $token->id]
            )->toArray();

            $card['card_id'] = $card['id'];
            $card['user_id'] = auth()->user()->id;
            $card['customer_id'] = auth()->user()->customer_id;
            $card['card_number'] = $request->card_number;
            $card['cvv'] = $request->cvv;
            $card['is_default'] = Card::where('user_id', auth()->user()->id)->where('is_default', '1')->first() ? '0' : '1';

            Card::create($card);
            $cards = Card::whereUserId(auth()->user()->id)->select(['id', 'last4', 'is_default', 'card_id'])->get();
            return parent::resp(true, 'Card has been successfully added', $cards);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function cardsAndWallet()
    {
        try {
            $this->cards = Card::whereUserId(auth()->user()->id)->latest()->get();
            $this->wallet = Wallet::whereUserId(auth()->user()->id)->first();
            $this->autoRefillLimit = settings('auto_refill_limit');

            return parent::resp(true, 'Here are your Cards', $this->data);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function makeDefaultCard(Request $request, $id)
    {
        try {
            Card::whereUserId(auth()->user()->id)->whereIsDefault('1')->update(['is_default' => '0']);
            Card::find($id)->update(['is_default' => '1']);

            return parent::resp(true, 'Card has been set as default', null);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function deleteCard(Request $request, $id)
    {
        try {
            $card = Card::find($id);

            $this->stripe->customers->deleteSource(
                auth()->user()->customer_id,
                $card->card_id,
                []
            );

            $card->delete();

            $cards = Card::whereUserId(auth()->user()->id)->select(['id', 'last4', 'is_default', 'card_id'])->get();
            return parent::resp(true, 'Card has been deleted successfully.', $cards);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function updateWalletSetting(Request $req)
    {
        try {
            if (!$req->auto_refill_amount) return response()->json(['success' => false, 'message' => 'Please choose any amount']);

            $data = $req->except('_token');
            $data['user_id'] = auth()->user()->id;
            Wallet::updateOrCreate(['user_id' => $data['user_id']], $data);

            return parent::resp(true, 'Wallet setting updated', $data);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }

    public function purchase(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), ['card_id' => 'required',]);
            if ($validator->fails()) {
                return parent::resp(false, 'Validation errors', null, $validator->errors());
            }

            $this->stripe->charges->create([
                'amount' => $req->auto_refill_amount * 100,
                'currency' => 'usd',
                'customer' => auth()->user()->customer_id,
                'source' => $req->card_id,
                'description' => auth()->user()->first_name . ' ' . auth()->user()->last_name . ' recharged their wallet',
            ]);

            $this->wallet = Wallet::whereUserId(auth()->user()->id)->first();
            $this->wallet->increment('amount', $req->auto_refill_amount);

            return parent::resp(true, 'Wallet amount has been updated.', $this->data);
        } catch (\Throwable $th) {
            return parent::resp(false, "Something unexpected happened on server. " . $th->getMessage());
        }
    }
}
