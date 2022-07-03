<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sid = getenv('TWILLO_SID');
        $token = getenv('TWILLO_AUTH_TOKEN');

        $twilio = new Client($sid, $token); 
        
        // $message = $twilio->messages 
        //                 ->create("whatsapp:+919166386953", // to 
        //                         array( 
        //                             "from" => "whatsapp:+14155238886",       
        //                             "body" => "Saurabh! This is an editable text message. You are free to change it and write whatever you like." 
        //                         ) 
        //                 ); 

        $message = $twilio->messages 
        ->create("whatsapp:+919460134097", // to 
                array( 
                    "from" => "whatsapp:+14155238886",       
                    "body" => "Saurabh! This is an editable text message. You are free to change it and write whatever you like." 
                ) 
        ); 
        
        print($message->sid);
        dd();
        return view('home');
    }
}
