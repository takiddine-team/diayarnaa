<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\FAQ;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Faq\StoreFaqFormRequest;
use App\Http\Requests\Backend\Faq\UpdateFaqFormRequest;

class FaqController extends Controller
{ // ========================================================================
    // ====================== index Function =======================
    // ==================== Created By Lujain Al-Smadi ======================
    // ========================================================================
    public function index(Route $route)
    {
        try {
            $faqs = FAQ::all();
            return view('admin.faqs.index', compact('faqs'));
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
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
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    // ========================================================================
    // ====================== create Function =======================
    // ==================== Created By Lujain Al-Smadi ======================
    // ========================================================================
    public function create(Route $route)
    {
        try {
            return view('admin.faqs.create');
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
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
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    // ========================================================================
    // ====================== store Function =======================
    // ==================== Created By Lujain Al-Smadi ======================
    // ========================================================================
    public function store(StoreFaqFormRequest $request, Route $route)
    {
        try {
            $request_data = [
                'faq_question_ar' => $request->faq_question_ar,
                'faq_question_en' => $request->faq_question_en,
                'faq_answer_ar' => $request->faq_answer_ar,
                'faq_answer_en' => $request->faq_answer_en,
                'status' => $request->status,
            ];
            DB::transaction(function () use ($request_data) {
                FAQ::create($request_data);
            });
            return redirect()->route('super_admin.faqs-index')->with('success', 'FAQ Added Successfully');
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
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
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    // ========================================================================
    // ====================== show Function =======================
    // ==================== Created By Lujain Al-Smadi ======================
    // ========================================================================
    public function show($id)
    {
        //
    }

    // ========================================================================
    // ====================== edit Function =======================
    // ==================== Created By Lujain Al-Smadi ======================
    // ========================================================================
    public function edit($id, Route $route)
    {
        try {
            $faq = FAQ::find($id);
            if ($faq) {
                return view('admin.faqs.edit', compact('faq'));
            } else {
                return redirect()->route('super_admin.faqs-index')->with('danger', 'FAQ Not Found');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
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
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }
    // ========================================================================
    // ====================== update Function =======================
    // ==================== Created By Lujain Al-Smadi ======================
    // ========================================================================
    public function update(UpdateFaqFormRequest $request, $id, Route $route)
    {
        try {
            $faq = FAQ::find($id);
            if ($faq) {
                $update_data = [
                    'faq_question_ar' => $request->faq_question_ar,
                    'faq_question_en' => $request->faq_question_en,
                    'faq_answer_ar' => $request->faq_answer_ar,
                    'faq_answer_en' => $request->faq_answer_en,
                    'status' => $request->status,
                ];
                DB::transaction(function () use ($update_data, $faq) {
                    $faq->update($update_data);
                });

                return redirect()->route('super_admin.faqs-index')->with('success', 'FAQ Updated Successfully');
            } else {
                return redirect()->route('super_admin.faqs-index')->with('danger', 'FAQ Not Found');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
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
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }


    // ========================================================================
    // ======================== Soft Delete Function ==========================
    
    // ========================================================================
    public function softDelete($id, Route $route)
    {
        try {
            $faq = Faq::find($id);
            if ($faq) {
                DB::transaction(function () use ($faq) {
                    $faq->delete();
                });
                return redirect()->route('super_admin.faqs-index')->with('success', 'The Deletion process has been successful');
            } else {
                return redirect()->back()->with('danger', 'This record is not in the records');
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
            return view('errors.support_tickets', compact(
                'th',
                'function_name',
                'end_error_ticket'
            ));
        }
    }

    // ========================================================================
    // ====================== Show Soft Delete Function =======================
    
    // ========================================================================
    public function showSoftDelete(Request $request, Route $route)
    {
        try {
            $faqs = new Faq();
            $faqs = $faqs->onlyTrashed()->select('*')->orderBy('created_at', 'asc')->get();
            return view('admin.faqs.trashed', compact('faqs'));
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
            return view('errors.support_tickets', compact(
                'th',
                'function_name',
                'end_error_ticket'
            ));
        }
    }

    // ========================================================================
    // ==================== Soft Delete Restore Function ======================
    
    // ========================================================================
    public function softDeleteRestore($id, Route $route)
    {
        try {
            $faq = Faq::onlyTrashed()->find($id);
            if ($faq) {
                DB::transaction(function () use ($faq) {
                    $faq->restore();
                });
                return redirect()->route('super_admin.faqs-showSoftDelete')->with('success', 'Restore Completed Successfully');
            } else {
                return redirect()->back()->with('danger', 'This section does not exist in the records');
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
            return view('errors.support_tickets', compact(
                'th',
                'function_name',
                'end_error_ticket'
            ));
        }
    }

    // ================================================================
    // ================== Active/Inactive Single ======================
    // ================================================================
    public function activeInactiveSingle($id, Route $route)
    {
        try {
            $faq = Faq::find($id);
            if ($faq) {
                if ($faq->status == 'Active') {
                    $faq->status = 2;  // 2 => Inactive
                } elseif ($faq->status == 'Inactive') {
                    $faq->status = 1;  // 1 => Active
                }
                $faq->save();
                return redirect()->back()->with('success', 'The process has successfully');
            } else {
                return redirect()->back()->with('danger', 'This record is not in the records');
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
            return view('errors.support_tickets', compact(
                'th',
                'function_name',
                'end_error_ticket'
            ));
        }
    }
}
