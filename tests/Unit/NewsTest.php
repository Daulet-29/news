<?php

namespace Tests\Unit;

use App\Services\NewsService;
use PHPUnit\Framework\TestCase;
use App\Services\NewsServiceInterface;

class NewsTest extends TestCase
{
    /**
     * @var NewsServiceInterface
     */
    private NewsServiceInterface $newsService;

    public function __construct(NewsServiceInterface $newsService)
    {
        $this->newsService = $newsService;
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function testNewsIndex()
    {
        $request = [
            "name" => "news",
            "description" => "news",
            "text" => 1,
            "publication_date"=> 1,
            "sign_of_publication" => 1
        ];
        return $this->assertTrue($this->newsService->update(1, $request)['success']);
    }
}
