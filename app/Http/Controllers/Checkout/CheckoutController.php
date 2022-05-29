<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Order;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Mollie\Laravel\Facades\Mollie;

class CheckoutController extends Controller
{
    public function checkout (Request $request) {
        $cart = Cart::session($request->list);
        $total = (string) $cart->getTotal();

        $order = new Order();
        $order->list_id = $request->list;
        $order->name = $request->name;
        $order->remarks = $request->remarks;
        $order->status = 'pending';
        $articles = json_decode($order->reserved_articles, true);
        $cartItems = $cart->getContent();
        foreach ($cartItems as $cartItem) {
            $articles[] = $cartItem->id;
        }
        $order->reserved_articles = json_encode($articles);
        $order->total = $total;
        $order->save();

        $webhookUrl = route('webhooks.mollie');
        if (App::environment('local')) {
            $webhookUrl = 'https://e6a8-2a02-1811-3c2d-b900-756c-3011-d2da-2b0.eu.ngrok.io/webhooks/mollie';
        }

        $total = number_format($total, 2);

        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => $total // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            "description" => "Bestelling op " . date('d-m-Y H:i:s'),
            "redirectUrl" => route('checkout.success'),
            "webhookUrl" => $webhookUrl,
            "metadata" => [
                "order_id" => $order->id,
                "order_from" => $request->name,
            ],
        ]);

        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function success (Request $request) {
        return view('success');
    }
}
