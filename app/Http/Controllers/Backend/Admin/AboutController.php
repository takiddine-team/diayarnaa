<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Abouts\UpdateAboutFormRequest;
use App\Models\About;
use App\Traits\SharedTrait;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;

use Illuminate\Routing\Route;
use App\Models\SupportTicket;
use Illuminate\Support\Facades\DB;

class AboutController extends Controller
{
    use SharedTrait, UploadImageTrait;


    // ================================================================
    // ======================== index Function ========================
    // ==================== Created By : Lujain Al-Smadi ==============
    // ================================================================
    public function index(Request $request, Route $route)
    {
        try {
            $about = About::first();
            return view('admin.abouts.index', compact('about'));
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
    // ======================== Edit Function =========================
    // ==================== Created By : Lujain Al-Smadi ==============
    // ================================================================
    public function edit($id, Route $route)
    {
        try {
            $about = About::find($id);
            if ($about) {
                return view('admin.abouts.edit', compact('about'));
            } else {
                return redirect()->route('super_admin.abouts-index')->with('danger', 'This record is not in the records');
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
    // ==================== Created By : Lujain Al-Smadi ==============
    // ================================================================
    public function update($id, UpdateAboutFormRequest $request, Route $route)
    {
        try {


            $about = About::find($id);
            if ($about) {
                // General Updated Data :
                $update_data = [
                    'about_description_en' => $request->about_description_en,
                    'about_description_ar' => $request->about_description_ar,
                    'our_message_en' => $request->our_message_en,
                    'our_message_ar' => $request->our_message_ar,
                    'our_vission_en' => $request->our_vission_en,
                    'our_vission_ar' => $request->our_vission_ar,
                    'our_value_en' => $request->our_value_en,
                    'our_value_ar' => $request->our_value_ar,

                ];
                if (isset($request->about_image)) {

                    $file_name = $this->saveFile($request->about_image, 'storage/about_us/');
                    $update_data['about_image'] = $file_name;
                }


                if (isset($request->our_message_image)) {

                    $file_name = $this->saveFile($request->our_message_image, 'storage/about_us/');
                    $update_data['our_message_image'] = $file_name;
                }

                if (isset($request->our_vission_image)) {

                    $file_name = $this->saveFile($request->our_vission_image, 'storage/about_us/');
                    $update_data['our_vission_image'] = $file_name;
                }


                if (isset($request->our_value_image)) {

                    $file_name = $this->saveFile($request->our_value_image, 'storage/about_us/');
                    $update_data['our_value_image'] = $file_name;
                }
                
                if (isset($request->background_aboutus_image)) {

                    $file_name = $this->saveFile($request->background_aboutus_image, 'storage/about_us/');
                    $update_data['background_aboutus_image'] = $file_name;
                }

                if (isset($request->background_company_image)) {

                    $file_name = $this->saveFile($request->background_company_image, 'storage/about_us/');
                    $update_data['background_company_image'] = $file_name;
                }


                DB::transaction(function () use ($update_data, $id) {
                    DB::table('abouts')->where('id', $id)->update($update_data);
                });
                return redirect()->route('super_admin.abouts-index')->with('success', 'The data has been successfully updated');
            } else {
                return redirect()->route('super_admin.abouts-index')->with('danger', 'This record does not exist in the records');
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
