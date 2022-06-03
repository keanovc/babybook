<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Article;
use App\Models\Babylist;
use App\Models\Order;

class ExportController extends Controller
{
    public function pdf (Request $request, $list) {
        $list = Babylist::find($list);
        $orders = Order::where('babylist_id', $list->id)->get();
        $reservedArticles = [];
        foreach ($orders as $order) {
            $reservedArticles = array_merge($reservedArticles, json_decode($order->reserved_articles));
        }
        $reservedArticles = Article::whereIn('id', $reservedArticles)->get();
        $articles = Article::whereIn('id', json_decode($list->articles))->get();
        $articles = $articles->diff($reservedArticles);

        $totalPrice = 0;
        foreach ($articles as $article) {
            $totalPrice += $article->price;
        }

        $pdf = PDF::loadView('pdf', compact('articles', 'list', 'totalPrice'));

        return $pdf->download('list.pdf');
    }
}
