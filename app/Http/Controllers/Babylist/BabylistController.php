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

    public function items(Request $request, $list)
    {
        $list = Babylist::find($list);
        $articles = Article::whereIn('id', json_decode($list->articles))->get();

        return view('items', compact('list', 'articles'));
    }

    public function addlist(Request $request)
    {
        return view('addlist');
    }

    public function additems(Request $request, $list)
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
        $babylist = new Babylist;
        $babylist->name = $request->name;
        $babylist->description = $request->description;
        $babylist->invitation_code = $request->invite;
        $babylist->user_id = $request->user()->id;
        $babylist->articles = json_encode([]);
        $babylist->save();

        return redirect()->route('dashboard')->with('success', 'List created');
    }

    public function storeItems(Request $request)
    {
        $list = $request->list;
        $listTotal = Babylist::find($request->list);
        $articles = json_decode($listTotal->articles, true);
        $articles[] = $request->article;
        $listTotal->articles = json_encode($articles);
        $listTotal->save();


        return redirect()->route('additems', $list)->with('success', 'Article added');
    }

    public function guestlist (Request $request) {
        $invitationCode = $request->invitation_code;
        $list = Babylist::where('invitation_code', $invitationCode)->first();

        if ($list) {
            $articles = Article::whereIn('id', json_decode($list->articles))->get();

            return view('guestlist', compact('list', 'articles'));
        } else {
            return redirect()->route('invitation')->with('error', 'Invalid invitation code');
        }
    }
}
