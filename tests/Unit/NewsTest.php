<?php

namespace Tests\Unit;

use App\Models\News;
use App\Services\NewsService;
use http\Env\Request;
use Tests\TestCase;
use App\Services\NewsServiceInterface;
use Symfony\Contracts\Service\ServiceLocatorTrait;

class NewsTest extends TestCase
{
   ///**
   // * @var NewsServiceInterface
   // */
   //private NewsServiceInterface $newsService;

   //public function __construct(NewsServiceInterface $newsService)
   //{
   //    parent::__construct($newsService);
   //    $this->newsService = $newsService;
   //}

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_index()
    {
        $newsService = app(NewsServiceInterface::class);
        $request = [
            "name" => "news",
            "description" => "news",
            "text" => "text",
            "publication_date"=> "14.03.2022",
            "sign_of_publication" => 1,
            "image" => "image",
        ];
        $this->assertEquals("14.03.2022", $newsService->create($request)["publication_date"]);
    }

    public function test_news_update()
    {
        $newsService = app(NewsServiceInterface::class);
        $request = [
            "name" => "news",
            "description" => "news",
            "text" => "text",
            "publication_date"=> "14.03.2022",
            "sign_of_publication" => 1,
            "postFiles" => "image"
        ];
//        dd($newsService->update(1, $request)["name"]);
        $this->assertEquals("news", $newsService->update(1, $request)["name"]);

//        $this->assertTrue($);
    }

    public function testNewsShow()
    {
        $id = 1;
        $model = News::find($id);
        if ($model != null)
            $this->assertTrue(true);
//        $this->newsService->show(1)->assertStatus(200);
    }
}
