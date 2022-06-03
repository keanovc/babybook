<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
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
        // get total price of list
        $totalPrice = 0;
        foreach ($articles as $article) {
            $totalPrice += $article->price;
        }

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('pdf', compact('articles', 'list', 'totalPrice')));

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('birthlist.pdf', array("Attachment" => false));
    }
}
