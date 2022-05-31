<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use App\Models\Article;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $articles = json_decode($this->order->reserved_articles, true);
        $articles = Article::whereIn('id', $articles)->get();

        return $this->view('email')
                    ->with([
                        'orderName' => $this->order->name,
                        'orderRemarks' => $this->order->remarks,
                        'orderTotal' => $this->order->total,
                        'articles' => $articles,
                    ]);
    }
}
