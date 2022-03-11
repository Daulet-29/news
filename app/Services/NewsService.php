<?php


namespace App\Services;


use App\Http\Resources\NewsResource;
use App\Repository\NewsRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Client\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class NewsService implements NewsServiceInterface
{
    /**
     * @var NewsRepositoryInterface
     */
    private NewsRepositoryInterface $newsRepository;

    /**
     * NewsService constructor.
     * @param NewsRepositoryInterface $newsRepository
     */
    public function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * @return Model[]|Collection
     */
    public function index()
    {
        return $this->newsRepository->all();
    }

    /**
     * @param $request
     * @return JsonResponse
     */
    public function create($request)
    {
        $model = $this->newsRepository->create($request);

        if ($model && isset($request['postFiles'])) {
            foreach ($request['postFiles'] as $file) {
                $fileName = $file->getClientOriginalName();
                $content = file_get_contents($file->getRealPath());
                try {
                    Storage::disk('local')->put("public/news/$model->id/".$fileName, $content);
                    $model->image = "public/news/$model->id/".$fileName;
                    $model->update();
                } catch (\Exception $ex){
                    if ($model->id){
                        $model->delete();
                    }
                    if (Storage::exists("public/news/$model->id")){
                        Storage::deleteDirectory("public/news/$model->id");
                    }
                    return response()->json([
                        'success' => false,
                        'error' => $ex->getMessage(),
                    ]);
                }
            }
        }
        return response()->json(['message' => 'Успешно сохранено!', 'success' => true, 'data' => $model], 200);
    }

    public function update(Request $request, $id)
    {
        try {
            $model = $this->newsRepository->find($id);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()]);
        }
        foreach ($request['postFiles'] as $file) {
            $fileName = $file->getClientOriginalName();
            $content = file_get_contents($file->getRealPath());
            Storage::disk('local')->put("public/news/$model->id/".$fileName, $content);
            $model->image = "public/news/$model->id/".$fileName;
            $model->update();
        }

        $updated = $this->newsRepository->update($model->id, (array)$model);
        return response()->json([
            'success' => true, 'message' => 'Успешно обновлено!', 'result' => $updated
        ]);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id)
    {
        return $this->newsRepository->find($id);
    }

    /**
     * @param $company_id
     * @param $updated_by
     * @param $created_by
     * @return JsonResponse
     */
}
