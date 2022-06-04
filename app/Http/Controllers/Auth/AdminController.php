<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Category;

class AdminController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    // public function create()
    // {
    //     return view('auth.admin');
    // }

    public function show(Request $request)
    {
        $shops = [
            'babyplanet' => 'Baby Planet',
            'bollebuik' => 'Bollebuik',
            'dekinderplaneet' => 'De Kinder Planeet',
        ];

        if ($request->shop) {
            $currentShopSmall = $request->shop;
        } else {
            $currentShopSmall = 'babyplanet';
        }

        $categories = Category::where('shop', $currentShopSmall)->get();
        $currentShop = $shops[$currentShopSmall];

        unset($shops[$currentShopSmall]);

        $articles = Article::join('categories', 'articles.category_id', '=', 'categories.id')
            ->where('categories.shop', $currentShopSmall)
            ->select('articles.*', 'categories.title as category_title')
            ->get();

        return view('adminDashboard', compact('articles', 'shops', 'currentShop'));
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        // authenticate the user and redirect to the intended page if admin from user is false
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => true])) {
            $request->authenticate();

            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::ADMIN);
        }

        return redirect()->route('admin')->with('error', 'Admin does not exist');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function destroy(Request $request)
    // {
    //     Auth::guard('web')->logout();

    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();

    //     return redirect('/');
    // }
}
