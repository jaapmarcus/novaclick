<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentCheckController extends Controller
{
    public function checkpayment()
    {
        sleep(2);
        if(auth()->user()->hasActiveSubscription('default')){
            return redirect()->route('wizard');
        }else{
            return redirect()->route('subscribe');
        }
    }
}
