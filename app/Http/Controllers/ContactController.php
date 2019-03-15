<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
Use App\Message;

class ContactController extends Controller
{
   public function get(){
       $contacts = User::all();
       return response()->json($contacts);
   }

   public function getMessagesFor($id ){
    $messages = Message::where('from',$id)->orwhere('to',$id)->get();
    return response()->json($messages);
   }

   public function send(Request $request)
   {
       $message = Message::create([
           'from' => auth()->id(),
           'to' => $request->contact_id,
           'text' => $request->text
       ]);

       return response()->json($message);
   }

}
