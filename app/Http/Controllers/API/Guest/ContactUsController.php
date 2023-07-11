<?php

namespace App\Http\Controllers\API\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evenement;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function ContactUs(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'subject'=>'required',
            'message'=>'required'
        ]);
        $mail_data=[
            'recipient'=>'azizbenamor1288@gmail.com',//a changer
            'fromEmail'=>$request->email,
            'fromName'=>$request->name,
            'subject'=>$request->subject,
            'body'=>$request->message
        ];
        Mail::send('emailTemplate/ContactUs', $mail_data, function ($message) use ($mail_data) {
            $message->to($mail_data['recipient'])
            ->from($mail_data['fromEmail'],'Yooreed Contact US')
            ->subject($mail_data['subject']);
        });
        return response([
            'message'=>'E-mail envoyé avec succès'
        ],200); 
        
    }
}
