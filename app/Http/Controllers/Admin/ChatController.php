<?php

namespace App\Http\Controllers\Admin;
use App\Models\Order;
use App\Models\ChatMessage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends AdminBaseController
{
    public function index(){
      
          $this->order=Order::with('user')->get();
          $order_id=$this->order[0]->id;
          $this->messages = ChatMessage::where('order_id',$order_id)->with('user','order')->get();
          return view('admin.chat.index',$this->data);
    }

    public function getChatMessage($id){
         $this->order=Order::with('user')->get();
         $this->messages = ChatMessage::where('order_id',$id)->with('user','order')->get();
         return view('admin.chat.index',$this->data);
    }
}
