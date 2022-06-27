<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function store(Request $request)
    {
        $defaultMail = 'lucaslpra@gmail.com';
        $email = new SendEmail(
            $request->nome,
            $request->email,
            $request->assunto,
            $request->mensagem
        );

        $when = now()->addSeconds(2);
        Mail::to($defaultMail)->later($when , $email);

        return redirect()->back();
    }
}
