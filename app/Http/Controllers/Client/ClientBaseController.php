<?php

namespace App\Http\Controllers\Client;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class ClientBaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $data = [];
    private $stripe = '';

    public function __get($property) {
        if (property_exists($this, $property)) {
            if($property == 'stripe'){
                return new \Stripe\StripeClient(config('stripe.LIVE_MODE') ? config('stripe.LIVE_SECRET_KEY') : config('stripe.TEST_SECRET_KEY'));
            }
            return $this->$property;
        }else{
            return $this->data[$property];
        }
    }

    public function __set($property, $value) {
        $this->data[$property] = $value;
    }

    public function resp($success,$message = null,$data = null, $validationErrors = null) {
        return response()->json(['success' => $success, 'message' => $message, 'data' => $data, 'validationErrors' => $validationErrors]);
    }
}
