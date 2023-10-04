<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\FeatureTypeSubCategory;
use App\Models\User;
use App\Models\UserMembership;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $password = Hash::make('12345678');

        // ======================================================================
        // ========================= Suepr Admin Section ========================
        // ======================================================================
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'super_admin@diyarnaa.com',
            'phone' => '079999999',
            'type' => '1',
            'password' => $password,
        ]);
  
        
       
       
    }
}
