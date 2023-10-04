<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

use GuzzleHttp\Client;

trait  SharedTrait
{


    // ========================================================================
    // ===================== Get Auth نوع المستخدم Function ======================
    // ========================================================================
    public function authUserType()
    {

        if (Auth::guard('super_admin')->check()) {
            return 'Super Admin';
        } elseif (Auth::guard('customer')->check()) {
            return 'customer';
        } else {
            return 'undefined';
        }
    }




    // ================================================================
    // ============ Calculate Coupon Expire Date Function =============
    // ================================================================
    function calculateExpireDate($duration)
    {
        // return $duration;
        if ($duration == 1) {
            return date('Y-m-d', strtotime(now() . ' + 1 days'));
        } elseif ($duration == 2) {
            return date('Y-m-d', strtotime(now() . ' + 2 days'));
        } elseif ($duration == 3) {
            return date('Y-m-d', strtotime(now() . ' + 3 days'));
        } elseif ($duration == 4) {
            return date('Y-m-d', strtotime(now() . ' + 4 days'));
        } elseif ($duration == 5) {
            return date('Y-m-d', strtotime(now() . ' + 5 days'));
        } elseif ($duration == 6) {
            return date('Y-m-d', strtotime(now() . ' + 6 days'));
        } elseif ($duration == 7) {
            return date('Y-m-d', strtotime(now() . ' + 1 week'));
        } elseif ($duration == 8) {
            return date('Y-m-d', strtotime(now() . ' + 2 weeks'));
        } elseif ($duration == 9) {
            return date('Y-m-d', strtotime(now() . ' + 3 week'));
        } elseif ($duration == 10) {
            return date('Y-m-d', strtotime(now() . ' + 1 month'));
        } elseif ($duration == 11) {
            return date('Y-m-d', strtotime(now() . ' + 2 months'));
        } elseif ($duration == 12) {
            return date('Y-m-d', strtotime(now() . ' + 3 months'));
        } elseif ($duration == 13) {
            return date('Y-m-d', strtotime(now() . ' + 6 months'));
        } else {
            return now();
        }
    }

    // ================================================================
    // =============== Any Third Party Request Function ===============
    // ================================================================
    public function sendRequest($base_uri, $authorization, $method, $uri)
    {

        $client = new Client(['base_uri' => $base_uri]);
        $headers = [
            'Authorization' => $authorization,
            'Accept'        => 'application/json',
        ];
        $response = $client->request($method, $uri, [
            'headers' => $headers
        ]);
        if ($response->getStatusCode() != 200) {
            return 'Error in request';
        }
        return $response = json_decode($response->getBody(), true);
    }
}
