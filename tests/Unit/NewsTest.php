<?php

namespace Tests\Unit;

use App\Models\News;
use App\Services\NewsService;
use Tests\TestCase;
use App\Services\NewsServiceInterface;
use Symfony\Contracts\Service\ServiceLocatorTrait;

class NewsTest extends TestCase
{
//    /**
//     * @var NewsServiceInterface
//     */
//    private NewsServiceInterface $newsService;
//
//    public function __construct(NewsServiceInterface $newsService)
//    {
//        parent::__construct($newsService);
//        $this->newsService = $newsService;
//    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_news_update()
    {
        $request = [
            "name" => "news",
            "description" => "news",
            "text" => "text",
            "publication_date"=> "14.03.2022",
            "sign_of_publication" => 1
        ];
        $this->assertTrue($this->newsService->update(1, $request)['success']);
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
