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
        return view('dashboard');
    }

    public function reserved(Request $request)
    {
        return view('reserved');
    }

    public function additems(Request $request)
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
        }

        return view('additems', compact('categoriesWithArticles', 'articlesWithPriceBelowHighest', 'currentCategoryTitle', 'currentCategoryShop', 'highestPrice', 'currentPrice', 'lowestPrice'));
    }

    public function storeitems(Request $request)
    {
        $babylist = new Babylist;
        $babylist->article_id = $request->article_id;
        $babylist->category_id = $request->category_id;
        $babylist->user_id = $request->user_id;
        $babylist->save();

        return redirect()->route('items')->with('success', 'Item added to category');
    }
}
