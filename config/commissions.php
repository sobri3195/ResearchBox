<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Commissions Payment Processor
    |--------------------------------------------------------------------------
    | Commission payment processor, switch to your country. 
	|
	| Note: Stripe has a global commission, PayPal varies by country.
    |
    */

     //<--- Paypal
    'paypal_fee' => 5.4, // Commission
    'paypal_cents' => 0.3, // Cents
    
    //<--- Stripe
    'stripe_fee' => 2.9, // Commission
    'stripe_cents' => 0.3, // Cents

);
