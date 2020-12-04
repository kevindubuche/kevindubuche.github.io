<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MailDelr;
use Illuminate\Support\Facades\Mail;
use Session;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function sendEmail(Request $request)
    {          
        //SEND EMAIL*****************************************
        $objDemo = new \stdClass();
        $objDemo->nom = $request->nom;
        $objDemo->email_source = $request->email_source;
        $objDemo->sujet = $request->sujet;
        $objDemo->messages = $request->messages;
        Mail::to('kevindubuche@gmail.com')->send(new MailDelr($objDemo));
      
        //FIN SEND EMAIL*****************************************
        Session::flash('succes', 'SUCCES !');
        return redirect()->back()->withInput($request->all());   
   
}
}
