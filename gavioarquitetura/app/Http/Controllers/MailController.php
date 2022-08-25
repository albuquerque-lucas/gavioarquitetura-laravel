<?php

namespace App\Http\Controllers;

use App\Events\EmailSent;
use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function store(Request $request)
    {

        EmailSent::dispatch($request->name, $request->email, $request->subject, $request->message);

        return redirect()->back();
    }
}
