<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function sendEmail() {
        $details = [
           'title' => ' Maison du web',
           'body' =>' '
        ];

        Mail::to("fatmaezzine4c@gmail.com")->send(new TestMail($details));
        return "email sent";
    }
}
