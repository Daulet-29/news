<?php


namespace App\Repository\Eloquent;

use App\Repository\Eloquent\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return Model[]|Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $id
     * @return Model
     */
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function findOrFail()
    {
        return $this->model->findOrFail();
    }

    /**
     * @param int $modelId
     * @param array $attributes
     * @return Model
     */
    public function update(int $modelId, array $attributes): Model
    {
        $model = $this->find($modelId);
        $model->update($attributes);
        return $model;
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return $this->model->query();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteById(int $id): bool
    {
        if ($this->find($id)) {
            return $model = $this->model->find($id)->delete();
        }
        return false;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function firstOrCreate(array $attributes)
    {
        return $this->model->firstOrCreate($attributes);
    }

    /**
     * @param array $attributes1
     * @param array $attributes2
     * @return mixed
     */
    public function createOrUpdate(array $attributes1, array $attributes2)
    {
        return $this->model->updateOrCreate($attributes1, $attributes2);
    }

    /**
     * @param $column
     * @param string $operator
     * @param $value
     * @return mixed
     */
    public function where($column, $operator, $value)
    {
        return $this->model->where($column,$operator,$value)->get()->last();
    }
}
