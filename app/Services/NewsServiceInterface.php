<?php


namespace App\Services;


use Illuminate\Http\Request;

interface NewsServiceInterface
{
    /**
     * @return mixed
     */
    public function index();

    /**
     * @param $request
     * @return mixed
     */
    public function create($request);

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id);

    /**
     * @param int $id
     * @param Request $request
     * @return mixed
     */
    public function update(int $id, Request $request);
}
