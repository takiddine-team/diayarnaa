<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\DiyarnaaCountry;
use App\Models\Feature;
use App\Models\Job;
use App\Models\MainCategory;
use App\Models\PaymentTransaction;
use App\Models\PremiumMembership;
use App\Models\SubCategory;
use App\Models\User;
use App\Models\UserMembership;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        $advertisements = Advertisement::get();
        $payment_transactions = PaymentTransaction::get();
        $users = User::get();
        $jobs = Job::get();
        $memberships = PremiumMembership::get();
        $user_memberships = UserMembership::get();
        $categories = MainCategory::get();
        $subCategories = SubCategory::get();
        $features = Feature::get();
        $diyarnaa_countries = DiyarnaaCountry::get();
        return view('admin.index',compact('advertisements','payment_transactions','users','jobs','memberships','user_memberships','categories','subCategories','features','diyarnaa_countries'));
    }
}
