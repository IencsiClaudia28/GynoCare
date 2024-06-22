<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\Token;
use Exception;
use App\Interfaces\PaymentServiceInterface;

class StripeService implements PaymentServiceInterface{
    public function __construct() {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function validateCard($cardDetails){
        try {
            Token::create([
                'card' => [
                    'number' => $cardDetails['card_number'],
                    'exp_month' => $cardDetails['exp_month'],
                    'exp_year' => $cardDetails['exp_year'],
                    'cvc' => $cardDetails['cvc']
                ]
            ]);

            return true;
        }
        catch(Exception $e) {
            return false;
        }
    }

    public function validateBankAccount($bankDetails) {
        try {
            Token::create([
                'bank_account' => [
                    'country' => $bankDetails['country'],
                    'currency' => $bankDetails['currency'],
                    'account_holder_name' => $bankDetails['account_holder_name'],
                    'account_holder_type' => $bankDetails['account_holder_type'],
                    'routing_number' => $bankDetails['routing_number'],
                    'account_number' => $bankDetails['account_number']
                ]
            ]);

            return true;
        }
        catch(Exception $e) {
            return false;
        }
    }
}