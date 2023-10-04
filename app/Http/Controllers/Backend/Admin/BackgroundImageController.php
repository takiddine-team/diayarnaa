<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BackgroundImage\UpdateBackgroundImageFormRequest;
use App\Models\BackgroundImage;
use App\Models\SupportTicket;
use App\Traits\SharedTrait;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class BackgroundImageController extends Controller
{
    use SharedTrait, UploadImageTrait;


    // ================================================================
    // ======================== index Function ========================
    // ==================== Created By : Lujain Al-Smadi ==============
    // ================================================================
    public function index(Request $request, Route $route)
    {
        try {
            $background_image = BackgroundImage::first();
            return view('admin.background_images.index', compact('background_image'));
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
            $background_image = BackgroundImage::find($id);
            if ($background_image) {
                return view('admin.background_images.edit', compact('background_image'));
            } else {
                return redirect()->route('super_admin.background_images-index')->with('danger', 'This record is not in the records');
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
    public function update($id, UpdateBackgroundImageFormRequest $request, Route $route)
    {
        try {
            $background_image = BackgroundImage::find($id);
            if ($background_image) {
                $update_data = [];
                if (isset($request->website_broker)) {
                    $file_name = $this->saveFile($request->website_broker, 'storage/BackgroundImage/');
                    $update_data['website_broker'] = $file_name;
                } else {
                    $update_data['website_broker'] = $background_image->website_broker;
                }

                if (isset($request->complaint)) {

                    $file_name = $this->saveFile($request->complaint, 'storage/BackgroundImage/');
                    $update_data['complaint'] = $file_name;
                } else {
                    $update_data['complaint'] = $background_image->complaint;
                }
                if (isset($request->job)) {

                    $file_name = $this->saveFile($request->job, 'storage/BackgroundImage/');
                    $update_data['job'] = $file_name;
                } else {
                    $update_data['job'] = $background_image->job;
                }
                if (isset($request->term_condition)) {

                    $file_name = $this->saveFile($request->term_condition, 'storage/BackgroundImage/');
                    $update_data['term_condition'] = $file_name;
                } else {
                    $update_data['term_condition'] = $background_image->term_condition;
                }
                if (isset($request->privacy_policy)) {

                    $file_name = $this->saveFile($request->privacy_policy, 'storage/BackgroundImage/');
                    $update_data['privacy_policy'] = $file_name;
                } else {
                    $update_data['privacy_policy'] = $background_image->privacy_policy;
                }
                if (isset($request->advertisement_details)) {

                    $file_name = $this->saveFile($request->advertisement_details, 'storage/BackgroundImage/');
                    $update_data['advertisement_details'] = $file_name;
                } else {
                    $update_data['advertisement_details'] = $background_image->advertisement_details;
                }
                if (isset($request->user_dashboard)) {

                    $file_name = $this->saveFile($request->user_dashboard, 'storage/BackgroundImage/');
                    $update_data['user_dashboard'] = $file_name;
                } else {
                    $update_data['user_dashboard'] = $background_image->user_dashboard;
                }
                if (isset($request->user_signup)) {

                    $file_name = $this->saveFile($request->user_signup, 'storage/BackgroundImage/');
                    $update_data['user_signup'] = $file_name;
                } else {
                    $update_data['user_signup'] = $background_image->user_signup;
                }
                if (isset($request->user_login)) {

                    $file_name = $this->saveFile($request->user_login, 'storage/BackgroundImage/');
                    $update_data['user_login'] = $file_name;
                } else {
                    $update_data['user_login'] = $background_image->user_login;
                }
                if (isset($request->customer_opinion)) {

                    $file_name = $this->saveFile($request->customer_opinion, 'storage/BackgroundImage/');
                    $update_data['customer_opinion'] = $file_name;
                } else {
                    $update_data['customer_opinion'] = $background_image->customer_opinion;
                }
                // return  $update_data;
                DB::transaction(function () use ($update_data, $id) {
                    DB::table('background_images')->where('id', $id)->update($update_data);
                });
                return redirect()->route('super_admin.background_images-index')->with('success', 'The data has been successfully updated');
            } else {
                return redirect()->route('super_admin.background_images-index')->with('danger', 'This record does not exist in the records');
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
