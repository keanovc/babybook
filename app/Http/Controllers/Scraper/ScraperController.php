<?php

namespace App\Http\Controllers\Scraper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Goutte\Client;
use stdClass;
use App\Models\Category;
use App\Models\Article;

class ScraperController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    // public function __invoke(Request $request)
    // {
    //     return view('scraper');
    // }

    public function show(Request $request)
    {
        $shops = [
            'flamingo' => 'De Gele Flamingo',
            'bolcom' => 'Bol.com',
            'dreambaby' => 'Dream Baby',
        ];

        $flamingoCategories = Category::all();

        return view('scraper', compact('shops', 'flamingoCategories'));
    }

    public function scrapeCategories(Request $request)
    {
        switch ($request->has('shop')) {
            case 'flamingo':
                $this->scrapeFlamingoCategories($request->url);
                break;
        }
    }

    private function scrapeFlamingoCategories($url)
    {
        $client = new Client();
        $crawler = $client->request('GET', $url);

        $categories = $crawler->filter('.collection-banner .collection-description ul li a')
                ->each(function ($node) {
                    $title = $node->text();
                    $url = $node->attr('href');

                    $cat = new stdClass();
                    $cat->title = $title;
                    $cat->url = $url;

                    return $cat;
                });

        foreach ($categories as $scrapeCategory) {
            $exists = Category::where('url', $scrapeCategory->url)->first();

            if ($exists > 0) continue;

            $categoryEntity = new Category();
            $categoryEntity->title = $scrapeCategory->title;
            $categoryEntity->url = $scrapeCategory->url;
            $categoryEntity->save();
        }
    }

    public function scrapeArticles(Request $request)
    {
        switch ($request->has('shop')) {
            case 'flamingo':
                return $this->scrapeFlamingoArticles($request->url);
                break;
        }
    }

    private function scrapeFlamingoArticles($url)
    {
        $client = new Client();
        $crawler = $client->request('GET', $url);

        $articles = $this->scrapeFlamingoPageData($crawler);

        for ($i = 0; $i <= 10; $i++) {
            $crawler = $this->getNextFlamingoPage($crawler);
            if (!$crawler) break;
            $articles = array_merge($articles, $this->scrapeFlamingoPageData($crawler));
        }

        foreach ($articles as $scrapeArticle) {
            $exists = Article::where('title', $scrapeArticle->title)->first();

            if ($exists > 0) continue;

            $articleEntity = new Article();
            $articleEntity->category_id = 1;
            $articleEntity->title = $scrapeArticle->title;
            $articleEntity->image = $scrapeArticle->image;
            $articleEntity->save();
        }
    }

    private function scrapeFlamingoPageData($crawler)
    {
        return $crawler->filter('.product-link')->each(function ($node) {
            $article = new stdClass();
            $article->title = $node->filter('.product-meta .product-title a')->first()->text();
            $article->image = $node->filter('.primary-image picture img')->first()->attr('src');
            return $article;
        });
    }

    private function getNextFlamingoPage($crawler)
    {
        $nextTag = $crawler->filter('.pagination__ajax')->selectLink('Toon meer items')->first();
        if ($nextTag->count() <= 0) return;

        $nextPage = $nextTag->link();
        if (!$nextPage) return;

        $client = new Client();
        $nextCrawler = $client->click($nextPage);

        return $nextCrawler;
    }
}
