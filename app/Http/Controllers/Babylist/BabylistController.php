<?php

namespace App\Http\Controllers\Babylist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\Babylist;
use App\Models\Order;
use Illuminate\Support\Facades\App;


class BabylistController extends Controller
{
    public function __invoke(Request $request)
    {
        $lists = $request->user()->lists;

        return view('dashboard', compact('lists'));
    }

    public function items(Request $request, Babylist $list)
    {
        if ($list->user_id != $request->user()->id) {
            return redirect()->route('dashboard')->with('error', __('List not found'));
        }

        $categories = Category::all();
        $categories_with_shops = [];
        foreach ($categories as $category) {
            $categories_with_shops[$category->id] = $category->shop;
        }
        $articles = Article::whereIn('id', json_decode($list->articles))->get();

        $orders = Order::where('babylist_id', $list->id)->get();
        $reservedArticles = [];
        foreach ($orders as $order) {
            $reservedArticles = array_merge($reservedArticles, json_decode($order->reserved_articles));
        }
        $reservedArticles = Article::whereIn('id', $reservedArticles)->get();
        $articles = $articles->diff($reservedArticles);

        return view('items', compact('list', 'articles', 'reservedArticles', 'categories_with_shops'));
    }

    public function addlist(Request $request)
    {
        return view('addlist');
    }

    public function additems(Request $request, Babylist $list)
    {
        $categories = Category::all();

        // check which category has articles
        $categoriesWithArticles = [];
        foreach ($categories as $category) {
            $category->articles = Article::where('category_id', $category->id)->get();
            if (count($category->articles) > 0) {
                $categoriesWithArticles[] = $category;
            }
        }

        if ($request->category) {
            $currentCategory = $request->category;
        } else {
            $currentCategory = $categoriesWithArticles[0]->id;
        }

        $currentCategoryTitle = Category::find($currentCategory)->title;
        $currentCategoryShop = Category::find($currentCategory)->shop;
        $articles = Article::where('category_id', $currentCategory)->get();

        $articlesInList = json_decode($list->articles);
        $articlesInList = Article::whereIn('id', $articlesInList)->get();

        $articles = $articles->diff($articlesInList);


        $highestPrice = 0;
        foreach ($articles as $article) {
            if ($article->price > $highestPrice) {
                $highestPrice = $article->price;
            }
        }

        $lowestPrice = $highestPrice;
        foreach ($articles as $article) {
            if ($article->price < $lowestPrice) {
                $lowestPrice = $article->price;
            }
        }

        $currentPrice = $request->price;

        $articlesWithPriceBelowHighest = [];
        foreach ($articles as $article) {
            if ($currentPrice) {
                if ($article->price <= $currentPrice) {
                    $articlesWithPriceBelowHighest[] = $article;
                }
            } elseif ($article->price <= floor(($highestPrice + $lowestPrice) / 2)) {
                $articlesWithPriceBelowHighest[] = $article;
            }
        };

        return view('additems', compact('categoriesWithArticles', 'articlesWithPriceBelowHighest', 'currentCategoryTitle', 'currentCategoryShop', 'highestPrice', 'currentPrice', 'lowestPrice', 'list'));
    }

    public function storeList(Request $request)
    {
        $code = '';
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        do {
            $charactersLength = strlen($characters);
            for ($i = 0; $i < 6; $i++) {
                $code .= $characters[rand(0, $charactersLength - 1)];
            }
        } while (Babylist::where('invitation_code', $code)->count() > 0);

        $request->user()->lists()->create([
            'name' => $request->name,
            'gender' => $request->gender,
            'description' => $request->description,
            'articles' => "[]",
            'invitation_code' => $code,
        ]);

        // $babylist = new Babylist;
        // $babylist->name = $request->name;
        // $babylist->gender = $request->gender;
        // $babylist->description = $request->description;
        // $babylist->invitation_code = $code;
        // $babylist->user_id = $request->user()->id;
        // $babylist->articles = json_encode([]);
        // $babylist->save();

        return redirect()->route('dashboard')->with('success', __('List created'));
    }

    public function storeItems(Request $request, Babylist $list)
    {
        $articles = json_decode($list->articles, true);
        $articles[] = $request->article;
        $list->articles = json_encode($articles);
        $list->save();

        return redirect()->route('additems', $list)->with('success', __('Article added'));
    }

    public function deleteList (Request $request, Babylist $list) {
        if (count(Order::where('babylist_id', $list->id)->get()) > 0) {
            return redirect()->route('dashboard')->with('error', __('List has orders'));
        } else {
            $list->delete();
            return redirect()->route('dashboard')->with('success', __('List deleted'));
        }
    }

    public function removeItems(Request $request, Babylist $list, $article)
    {
        $articles = json_decode($list->articles, true);
        $articles = array_diff($articles, [$article]);
        $articles = array_values($articles);
        $list->articles = json_encode($articles);
        $list->save();
        return redirect()->route('items', $list)->with('success', __('Article removed'));
    }

    public function orders (Request $request, Babylist $list) {
        $orders = Order::where('babylist_id', $list->id)->get();

        return view('orders', compact('orders', 'list'));
    }

    public function reserved(Request $request, Babylist $list, $order) {
        $order = Order::find($order);
        $articles = json_decode($order->reserved_articles);
        $articles = Article::whereIn('id', $articles)->get();

        return view('reserved', compact('articles', 'list', 'order'));
    }
}
