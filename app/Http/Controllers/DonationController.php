<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use MercadoPago\Payer;
use MercadoPago\Payment as MercadoPagoPayment;
use MercadoPago\SDK;

class DonationController extends Controller
{

    function index() {
        $donations = Donation::orderBy('created_at', 'DESC')
                                ->get();
        return response()->json(['donations' => $donations], 200);
    }
    
    function store(Request $request) { 
        $donation = Donation::create([
            'transaction_amount' => $request->transaction_amount,
            'token' => $request->token,
            'description' => $request->description,
            'installments' => $request->installments,
            'payment_method_id' => $request->payment_method_id,
            'issuer' => $request->issuer,
            'email' => $request->email,
            'doc_type' => $request->doc_type,
            'doc_number' => $request->doc_number,
        ]);
        $this->procesarPago($donation);
        return response()->json(['donation' => $donation], 201);
    }

    function procesarPago($donation) {
        SDK::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));

        $mp_payment = new MercadoPagoPayment();
        $mp_payment->transaction_amount = (float)$donation->transaction_amount;
        $mp_payment->token              = $donation->token;
        $mp_payment->installments       = (int)$donation->installments;
        $mp_payment->description        = $donation->description;
        $mp_payment->payment_method_id  = $donation->payment_method_id;
        $mp_payment->issuer_id          = (int)$donation->issuer;
        $payer = new Payer();
        $payer->email           = $donation->email;
        $payer->identification  = array(
            "type" => $donation->doc_type,
            "number" => $donation->doc_number
        );
        $mp_payment->payer = $payer;
        $mp_payment->save();

        $donation->payment_id    = $mp_payment->id;
        $donation->status        = $mp_payment->status;
        $donation->status_detail = $mp_payment->status_detail;
        $donation->save();
    }

    function notification(Request $request) {
        SDK::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));
        if ($request->topic == 'payment') {
            $donation = Donation::where('payment_id', $request->id);
            $payment_mp = MercadoPagoPayment::find_by_id($request->id);
            if (!is_null($donation) && !is_null($payment_mp)) {
                $donation->status = $payment_mp->status;
                $donation->status_detail = $payment_mp->status_detail;
                $donation->updated = 1;
                $donation->save();
            }
        }
        return response(null, 200);
    }
    
}
