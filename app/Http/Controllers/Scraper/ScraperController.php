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

        return view('scraper', compact('shops', 'currentShop', 'categories'));
    }

    public function scrapeCategories(Request $request)
    {
        switch ($request->shop) {
            case 'babyplanet':
                return $this->scrapeBabyPlanetCategories($request->url);
                break;
            case 'bollebuik':
                return $this->scrapeBollebuikCategories($request->url);
                break;
            case 'dekinderplaneet':
                return $this->scrapeDeKinderPlaneetCategories($request->url);
                break;
        }
    }

    private function scrapeBabyPlanetCategories($url)
    {
        $client = new Client();
        $crawler = $client->request('GET', $url);

        $categories = $crawler->filter('#maincontent > div.columns > div.sidebar.sidebar-main.wrapper > div > div.bp-wrapper.categories > div.body > ul > li > a')
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
            $categoryEntity->shop = 'babyplanet';
            $categoryEntity->title = $scrapeCategory->title;
            $categoryEntity->url = $scrapeCategory->url;
            $categoryEntity->save();
        }

        return redirect()->route('scraper.show');
    }

    private function scrapeBollebuikCategories($url)
    {
        $client = new Client();
        $crawler = $client->request('GET', $url);

        $categories = $crawler->filter('.categorie > ol > li')
                ->each(function ($node) {
                    $title = $node->filter('a')->text();
                    $title = explode($node->filter('a span')->text(), $title)[0];
                    $url = $node->filter('a')->attr('href');

                    $cat = new stdClass();
                    $cat->title = $title;
                    $cat->url = $url;

                    return $cat;
                });

        foreach ($categories as $scrapeCategory) {
            $exists = Category::where('url', $scrapeCategory->url)->first();

            if ($exists > 0) continue;

            $categoryEntity = new Category();
            $categoryEntity->shop = 'bollebuik';
            $categoryEntity->title = $scrapeCategory->title;
            $categoryEntity->url = $scrapeCategory->url;
            $categoryEntity->save();
        }

        return redirect()->route('scraper.show');
    }

    private function scrapeDeKinderPlaneetCategories($url)
    {
        $client = new Client();
        $crawler = $client->request('GET', $url);

        $categories = $crawler->filter('div.leftsidemenus > div > div.cnt > ul > li')
                ->each(function ($node) {
                    $title = $node->filter('a')->text();
                    $url = 'https://www.dekinderplaneet.be' . $node->filter('a')->attr('href');

                    $cat = new stdClass();
                    $cat->title = $title;
                    $cat->url = $url;

                    return $cat;
                });

        foreach ($categories as $scrapeCategory) {
            $exists = Category::where('url', $scrapeCategory->url)->first();

            if ($exists > 0) continue;

            $categoryEntity = new Category();
            $categoryEntity->shop = 'dekinderplaneet';
            $categoryEntity->title = $scrapeCategory->title;
            $categoryEntity->url = $scrapeCategory->url;
            $categoryEntity->save();
        }

        return redirect()->route('scraper.show');
    }

    public function scrapeArticles(Request $request)
    {
        switch ($request->shop) {
            case 'babyplanet':
                return $this->scrapeBabyPlanetArticles($request->url);
                break;
            case 'bollebuik':
                return $this->scrapeBollebuikArticles($request->url);
                break;
            case 'dekinderplaneet':
                return $this->scrapeDeKinderPlaneetArticles($request->url);
                break;
            }
    }

    private function scrapeBabyPlanetArticles($url)
    {
        $client = new Client();
        $crawler = $client->request('GET', $url);

        $articles = $this->scrapeBabyPlanetPageData($crawler);

        for ($i = 0; $i <= 10; $i++) {
            $crawler = $this->getNextBabyPlanetPage($crawler);
            if (!$crawler) break;
            $articles = array_merge($articles, $this->scrapeBabyPlanetPageData($crawler));
        }

        foreach ($articles as $scrapeArticle) {
            $exists = Article::where('title', $scrapeArticle->title)->first();
            $category = Category::where('url', $url)->first();

            if ($exists) continue;

            $articleEntity = new Article();
            $articleEntity->category_id = $category->id;
            $articleEntity->title = $scrapeArticle->title;
            $articleEntity->image = $this->saveImage($scrapeArticle->image);
            $articleEntity->price = $scrapeArticle->price;
            $articleEntity->url = $scrapeArticle->url;
            $articleEntity->save();
        }

        return redirect()->route('adminDashboard');
    }

    private function scrapeBabyPlanetPageData($crawler)
    {
        return $crawler->filter('#amasty-shopby-product-list > div.products.wrapper.grid.products-grid > ol > li')->each(function ($node) {
            $article = new stdClass();
            $article->title = $node->filter('div > div > strong > a')->first()->text();
            $article->image = $node->filter('div > a > span > span > img')->first()->attr('src');
            $article->price = $node->filter('div > .product-item-details > .product-item-inner > .price-box span.price')->first()->text();
            $article->price = str_replace('.', '', $article->price);
            $article->price = str_replace(',', '.', $article->price);
            $article->url = $node->filter('div > div > strong > a')->first()->attr('href');
            return $article;
        });
    }

    private function getNextBabyPlanetPage($crawler)
    {
        $nextTag = $crawler->filter('#amasty-shopby-product-list > div.toolbar.toolbar-products > div.pages > ul > li.item.pages-item-next > a')->selectLink('Volgende stap')->first();
        if ($nextTag->count() <= 0) return;

        $nextPage = $nextTag->link();
        if (!$nextPage) return;

        $client = new Client();
        $nextCrawler = $client->click($nextPage);

        return $nextCrawler;
    }

    private function scrapeBollebuikArticles($url)
    {
        $client = new Client();
        $crawler = $client->request('GET', $url);

        $articles = $this->scrapeBollebuikPageData($crawler);

        for ($i = 0; $i <= 10; $i++) {
            $crawler = $this->getNextBollebuikPage($crawler);
            if (!$crawler) break;
            $articles = array_merge($articles, $this->scrapeBollebuikPageData($crawler));
        }

        foreach ($articles as $scrapeArticle) {
            $exists = Article::where('title', $scrapeArticle->title)->first();
            $category = Category::where('url', $url)->first();

            if ($exists) continue;

            $articleEntity = new Article();
            $articleEntity->category_id = $category->id;
            $articleEntity->title = $scrapeArticle->title;
            $articleEntity->image = $this->saveImage($scrapeArticle->image);
            $articleEntity->price = $scrapeArticle->price;
            $articleEntity->url = $scrapeArticle->url;
            $articleEntity->save();
        }

        return redirect()->route('adminDashboard');
    }

    private function scrapeBollebuikPageData($crawler)
    {
        return $crawler->filter('body > div.wrapper > div.main-container.col2-left-layout > div > div.col-main > div.category-products > ul > li')->each(function ($node) {
            $article = new stdClass();
            $article->title = $node->filter('div.inner-wrap > h3 > a')->first()->text();
            $article->image = $node->filter('a > img')->first()->attr('src');
            if ($node->filter('div.inner-wrap > div > span')->count() > 0) {
                $article->price = $node->filter('div.inner-wrap > div > span.regular-price span.price')->first()->text();
            } else {
                $article->price = $node->filter('div.inner-wrap > div > p.special-price span.price')->first()->text();
            }
            $article->price = str_replace(',', '.', $article->price);
            $article->price = preg_replace('/[^0-9.]+/', '', $article->price);
            $article->url = $node->filter('div.inner-wrap > h3 > a')->first()->attr('href');
            return $article;
        });
    }

    private function getNextBollebuikPage($crawler)
    {
        $nextTag = $crawler->filter('body > div.wrapper > div.main-container.col2-left-layout > div > div.col-main > div.category-products > div.toolbar-bottom > div > div > div > ol > li > a.next')->selectLink('Volgende')->first();
        if ($nextTag->count() <= 0) return;

        $nextPage = $nextTag->link();
        if (!$nextPage) return;

        $client = new Client();
        $nextCrawler = $client->click($nextPage);

        return $nextCrawler;
    }

    private function scrapeDeKinderPlaneetArticles($url)
    {
        $client = new Client();
        $crawler = $client->request('GET', $url);

        $articles = $this->scrapeDeKinderPlaneetPageData($crawler);

        for ($i = 0; $i <= 10; $i++) {
            $crawler = $this->getNextDeKinderPlaneetPage($crawler);
            if (!$crawler) break;
            $articles = array_merge($articles, $this->scrapeDeKinderPlaneetPageData($crawler));
        }

        foreach ($articles as $scrapeArticle) {
            $exists = Article::where('title', $scrapeArticle->title)->first();
            $category = Category::where('url', $url)->first();

            if ($exists) continue;

            $articleEntity = new Article();
            $articleEntity->category_id = $category->id;
            $articleEntity->title = $scrapeArticle->title;
            $articleEntity->image = $this->saveImage($scrapeArticle->image);
            $articleEntity->price = $scrapeArticle->price;
            $articleEntity->url = $scrapeArticle->url;
            $articleEntity->save();
        }

        return redirect()->route('adminDashboard');
    }

    private function scrapeDeKinderPlaneetPageData($crawler)
    {
        return $crawler->filter('#list-of-products > div.l-products-item')->each(function ($node) {
            $article = new stdClass();
            $article->title = $node->filter('div.product-tile > div.product-info > div.product-description > a > span')->text();
            $article->image = 'https://www.dekinderplaneet.be' . $node->filter('div.product-tile > div.product-img > a > span > img')->first()->attr('src');
            $article->price = $node->filter('div.product-tile > div.product-info > div.product-action > span > span.lbl-price')->first()->text();
            $article->price = str_replace(',', '.', $article->price);
            $article->price = preg_replace('/[^0-9.]+/', '', $article->price);
            $article->url = 'https://www.dekinderplaneet.be' . $node->filter('div.product-tile > div.product-info > div.product-description > a')->first()->attr('href');
            return $article;
        });
    }

    private function getNextDeKinderPlaneetPage($crawler)
    {
        $nextTag = $crawler->filter('#product-list-panel > div.panel-footer > div > a')->first();
        if ($nextTag->count() <= 0) return;

        $nextPage = $nextTag->link();
        if (!$nextPage) return;

        $client = new Client();
        $nextCrawler = $client->click($nextPage);

        return $nextCrawler;
    }

    private function saveImage($image_url) {
        $image_name = uniqid() . '.jpg';
        $image_path = public_path('img/' . $image_name);

        $image = file_get_contents($image_url);
        file_put_contents($image_path, $image);

        return $image_name;
    }
}
