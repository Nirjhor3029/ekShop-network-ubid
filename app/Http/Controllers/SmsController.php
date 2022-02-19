<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SmsController extends Controller
{
    //
    public function sendSmsPage()
    {
        return view('backend.pages.sms.send');
    }
    public function campaignPage()
    {
        return view('backend.pages.sms.campaign');
    }
    public function senderIdPage()
    {
        return view('backend.pages.sms.sender_id');
    }
    public function templatesPage()
    {
        return view('backend.pages.sms.templates');
    }
}
