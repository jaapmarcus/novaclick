<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Cashier\Cashier;
use Illuminate\Http\Request;
use Laravel\Cashier\SubscriptionBuilder\RedirectToCheckoutResponse;
use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();
        $plan = 'Essential'; // The plan identifier from config/cashier_plans.php
        $name = 'Essential'; // The name of the subscription
        if(!$user->subscribed($name, $plan)) {

            $result = $user->newSubscription($name, $plan)->create();

            if(is_a($result, RedirectToCheckoutResponse::class)) {
                return $result; // Redirect to Mollie checkout
            }

            return back()->with('status', 'Welcome to the ' . $plan . ' plan');
        }
        return back()->with('status', 'You are already on the ' . $plan . ' plan');
    }
}
