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

        if ($list) {
            $orders = Order::where('babylist_id', $list->id)->get();
            $articles = Article::whereIn('id', json_decode($list->articles))->get();
            $reservedArticles = [];
            foreach ($orders as $order) {
                $reservedArticles = array_merge($reservedArticles, json_decode($order->reserved_articles));
            }
            $articles = $articles->filter(function ($article) use ($reservedArticles) {
                return ! in_array($article->id, $reservedArticles);
            });
            $cartItems = Cart::session($list->id)->getContent();

            return view('guestlist', compact('list', 'articles', 'cartItems', 'invitationCode'));
        } else {
            return redirect()->route('invitation')->with('error', __('Invalid invitation code'));
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

        return redirect()->back()->with('success', __('Article added to cart'));
    }

    public function cart (Request $request) {
        $cart = Cart::session($request->list);
        $list = Babylist::find($request->list);
        $invitationCode = $list->invitation_code;

        return view('cart', compact('cart', 'invitationCode', 'list'));
    }

    public function deleteitem (Request $request, $item) {
        $cart = Cart::session($request->list);
        $cart->remove($item);
        return redirect()->back();
    }
}
