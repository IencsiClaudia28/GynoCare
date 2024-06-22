<?php

namespace App\Interfaces;

interface PaymentServiceInterface {
    public function validateCard($cardDetails);
    public function validateBankAccount($bankDetails);
}