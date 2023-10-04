<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Mail\SendNewsletter;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Routing\Route;
use App\Models\NewsletterSubscribe;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Backend\Newsletter\NewsletterRequest;
use App\Mail\HelloEmail;

class NewsletterController extends Controller
{
    //==================================================
    //==========newsletterForm function ================
    //================Created By:Lujain Smadi================

    public function newsletterForm(Route $route)
    {
        try {
            return view('admin.newsletters.create');
        } catch (\Throwable $th) {
            $function_name =  $route->getActionName();
            $check_old_errors = new SupportTicket();
            $check_old_errors = $check_old_errors->select('*')->where([
                'error_location' => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name' => $function_name,
                'error_line' => $th->getLine(),
            ])->get();

            if ($check_old_errors->count() == 0) {
                $new_error_ticket = SupportTicket::create([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' =>  $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    //==================================================
    //==========send Newsletter function ================
    //================Created By:Lujain Smadi================

    public function sendNewsletter(Route $route, NewsletterRequest $request)
    {
        try {
            $newsletter_subscribes = NewsletterSubscribe::where('is_verified','=',2)->get();
            if ($newsletter_subscribes->count() > 0) {
                $data=$request;
                foreach ($newsletter_subscribes as $newsletter_subscriber) {
                    Mail::to($newsletter_subscriber->email)->send(new SendNewsletter($data));
                }
                return redirect()->back()->with('success', 'Newsletter sent successfully');
            } else {
                return redirect()->route('super_admin.newsletters-newsletterForm')->with('danger', 'There are no subscribers to the newsletter');
            }
        } catch (\Throwable $th) {
            $function_name =  $route->getActionName();
            $check_old_errors = new SupportTicket();
            $check_old_errors = $check_old_errors->select('*')->where([
                'error_location' => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name' => $function_name,
                'error_line' => $th->getLine(),
            ])->get();

            if ($check_old_errors->count() == 0) {
                $new_error_ticket = SupportTicket::create([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' =>  $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }


    //================================================================
    //==================== welcome Function Section ====================
    //====================Created by: Lujain Samdi=================
    //================================================================
    public function sendtestmail(Route $route)
    

    {
        // return 'erg';
        /** 
         * Store a receiver email address to a variable.
         */
        $reveiverEmailAddress = "q.khaled@bluerayws.com";

        /**
         * Import the Mail class at the top of this page,
         * and call the to() method for passing the 
         * receiver email address.
         * 
         * Also, call the send() method to incloude the
         * HelloEmail class that contains the email template.
         */
        Mail::to($reveiverEmailAddress)->send(new HelloEmail);

        /**
         * Check if the email has been sent successfully, or not.
         * Return the appropriate message.
         */
        if (Mail::failures() != 0) {
            return "Email has been sent successfully.";
        }
        return "Oops! There was some error sending the email.";
    }


    
}
