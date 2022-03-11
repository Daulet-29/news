<?php


namespace App\Repository;

use App\Models\News;
use App\Repository\Eloquent\BaseRepository;

class NewsRepository extends BaseRepository implements NewsRepositoryInterface
{
    public function __construct(News $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }
}
