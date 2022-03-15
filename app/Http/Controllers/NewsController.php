<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsRequest;
use App\Http\Resources\NewsResource;
use App\Repository\NewsRepositoryInterface;
use App\Services\NewsServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class NewsController extends Controller
{

    /**
     * @var NewsRepositoryInterface
     */
    private NewsRepositoryInterface $newsRepository;

    /**
     * @var NewsServiceInterface
     */
    private NewsServiceInterface $newsService;

    public function __construct(NewsRepositoryInterface $newsRepository, NewsServiceInterface $newsService)
    {
        $this->newsRepository = $newsRepository;
        $this->newsService = $newsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->newsService->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNewsRequest $request
     * @return JsonResponse
     */
    public function store(StoreNewsRequest $request)
    {
        $result = $this->newsService->create($request->all());
        if ($this->newsService->create($request->all())) {
            return response()->json([
                'success' => true, 'message' => 'Успешно сохранено!', 'result' => new NewsResource($result)
            ], 200);
        }
        return response()->json([
            'success' => false, 'message' => 'Не удалось сохранить!'
        ], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        if ($this->newsService->show($id)){
            return response()->json([
                'success' => true,
                'data' =>  $this->newsService->show($id)
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'News not found!',
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param StoreNewsRequest $request
     * @return JsonResponse
     */
    public function update($id, StoreNewsRequest $request)
    {
        if ($this->newsService->update($id, $request->all())){
            return response()->json([
                'success' => true,
                'data' =>  $this->newsService->update($id, $request)
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Failed to update!',
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        if ($this->newsRepository->deleteById($id)) {
            $this->newsRepository->deleteById($id);
            return response()->json([
                'success' => true,
                'message' => 'Успешно удалено!'
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Не удалось найти данные по id!'
        ]);
    }
}
