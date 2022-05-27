<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Article;
use App\Models\Babylist;
use App\Models\Order;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Mollie\Laravel\Facades\Mollie;

class CartController extends Controller
{
    public function invitation (Request $request)
    {
        return view('invitation');
    }

    public function guestlist (Request $request) {
        $invitationCode = $request->invitation_code;
        $list = Babylist::where('invitation_code', $invitationCode)->first();
        $order = Order::where('list_id', $list->id)->first();

        if ($list) {
            $articles = Article::whereIn('id', json_decode($list->articles))->get();
            $reservedArticles = json_decode($order->reserved_articles);
            $articles = $articles->filter(function ($article) use ($reservedArticles) {
                return ! in_array($article->id, $reservedArticles);
            });
            $cartItems = Cart::session($list->id)->getContent();

            return view('guestlist', compact('list', 'articles', 'cartItems'));
        } else {
            return redirect()->route('invitation')->with('error', 'Invalid invitation code');
        }
    }

    public function cartitem (Request $request) {
        $article = Article::find($request->article);

        // add the product to cart
        Cart::session($request->list)->add(array(
            'id' => $article->id,
            'name' => $article->title,
            'price' => $article->price,
            'quantity' => 1,
            'attributes' => array(
                'image' => $article->image,
            ),
            'associatedModel' => $article
        ));

        return redirect()->back();
    }

    public function cart (Request $request) {
        $cart = Cart::session($request->list);
        $list = Babylist::find($request->list);
        $invitationCode = $list->invitation_code;

        return view('cart', compact('cart', 'invitationCode', 'list'));
    }

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
            $webhookUrl = 'https://3ea6-2a02-1811-3c2d-b900-159a-7194-ec47-6cd4.eu.ngrok.io/webhooks/mollie';
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
        return 'success';
    }

    public function deleteitem (Request $request, $item) {
        dd($item);
        $cart = Cart::session($request->list);
        $cart->remove($request->item);
        return redirect()->back();
    }
}
