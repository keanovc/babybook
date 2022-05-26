<?php

namespace App\Http\Controllers\Babylist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\Babylist;
use App\Models\User;

class BabylistController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();
        $lists = $user->lists;

        return view('dashboard', compact('lists'));
    }

    public function reserved(Request $request)
    {
        return view('reserved');
    }

    public function items(Request $request)
    {
        $listId = $request->route('list');

        return view('items', compact('listId'));
    }

    public function addlist(Request $request)
    {
        return view('addlist');
    }

    public function additems(Request $request, Babylist $list)
    {
        $listId = $request->route('list');

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
        }

        $user = $request->user();
        $list = $user->lists()->find($list);

        return view('additems', compact('categoriesWithArticles', 'articlesWithPriceBelowHighest', 'currentCategoryTitle', 'currentCategoryShop', 'highestPrice', 'currentPrice', 'lowestPrice', 'listId'));
    }

    public function storeList(Request $request)
    {
        $babylist = new Babylist;
        $babylist->name = $request->name;
        $babylist->description = $request->description;
        $babylist->invitation_code = $request->invite;
        $babylist->user_id = $request->user()->id;
        $babylist->save();

        return redirect()->route('dashboard')->with('success', 'List created');
    }

    public function storeItems(Request $request)
    {
        $listId = $request->route('list');
        $user = $request->user();
        $list = $user->lists()->find($listId);

        dd($list);

        return redirect()->route('items')->with('success', 'Items added');
    }

    public function guestlist (Request $request) {
        $invitationCode = $request->invitation_code;
        $list = Babylist::where('invitation_code', $invitationCode)->first();

        return view('guestlist', compact('list'));
    }
}
