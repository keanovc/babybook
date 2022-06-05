<?php

namespace App\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;
use App\Models\Order;
use Darryldecode\Cart\Facades\CartFacade as Cart;


class WebhookController extends Controller
{
    public function handleWebhookNotification(Request $request) {
        $paymentId = $request->input('id');

        $payment = Mollie::api()->payments->get($paymentId);

        if ($payment->isPaid() && ! $payment->hasRefunds() && ! $payment->hasChargebacks()) {

            $orderId = $payment->metadata->order_id;
            $order = Order::findOrFail($orderId);
            $order->status = 'paid';
            $order->save();

            Cart::session($orderId)->clear();

        } elseif ($payment->isOpen()) {
            /*
             * The payment is open.
             */
        } elseif ($payment->isPending()) {
            /*
             * The payment is pending.
             */
        } elseif ($payment->isFailed()) {
            /*
             * The payment has failed.
             */
        } elseif ($payment->isExpired()) {
            /*
             * The payment is expired.
             */
        } elseif ($payment->isCanceled()) {
            /*
             * The payment has been canceled.
             */
        } elseif ($payment->hasRefunds()) {
            /*
             * The payment has been (partially) refunded.
             * The status of the payment is still "paid"
             */
        } elseif ($payment->hasChargebacks()) {
            /*
             * The payment has been (partially) charged back.
             * The status of the payment is still "paid"
             */
        }
    }
}
