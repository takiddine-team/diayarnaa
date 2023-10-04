<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\ContactUs;
use App\Traits\SharedTrait;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Routing\Route;
use App\Models\ContactUsRequest;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ContactUs\UpdateContactUsFormRequest;

class ContactUsController extends Controller
{
    use SharedTrait, UploadImageTrait;

    // ================================================================
    // ======================== index Function ========================
    // ================================================================
    public function index(Request $request, Route $route)
    {
        try {
            $contact = ContactUs::first();
            return view('admin.contact_us.index', compact('contact'));
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

    // ================================================================
    // ======================== edit Function =========================
    // ================================================================
    public function edit(Request $request, Route $route)
    {
        try {
            $contact = ContactUs::first();
            if($contact){
                return view('admin.contact_us.edit', compact('contact'));
            }
            else{
                return redirect()->route('super_admin.contact_us-index')->with('danger', 'هذا السجل غير موجود في السجلات');
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

    // ================================================================
    // ======================= Update Function ========================
    // ================================================================
    public function update(UpdateContactUsFormRequest $request,  Route $route)
    {
        try {

  
            $contact = ContactUs::first();
            if ($contact) {
                $update_data = [
                    'phone' => $request->phone,
                    'phone_two' => $request->phone_two,
                    'email' => $request->email,
                    'url_map' => $request->url_map,
                    'facebook' => $request->facebook,
                    'twitter' => $request->twitter,
                    'instagram' => $request->instagram,
                    'linkedin' => $request->linkedin,
                    'messanger' => $request->messanger,
                    'youtube'=> $request->youtube

                ];
                if (isset($request->background_image)) {

                    $file_name = $this->saveFile($request->background_image, 'storage/contact_us/');
                    $update_data['background_image'] = $file_name;
                }


                DB::transaction(function () use ($update_data, $contact) {
                    DB::table('contact_us')->where('id', $contact->id)->update($update_data);
                });
                return redirect()->route('super_admin.contact_us-index')->with('success', 'The data has been successfully updated');
            } else {
                return redirect()->route('super_admin.contact_us-index')->with('danger', 'This record does not exist in the records');
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

}
