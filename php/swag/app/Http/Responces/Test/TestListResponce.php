<?php

namespace App\Http\Responces\Test;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Schema(
 *     title="TestListResponce",
 *     description="TestListResponce",
 * )
 */
class TestListResponce
{
/**
 * @OA\Property(
 *     title="Tests[]",
 *     description="array of Test",
 *     type="array",
 *      @OA\Items(
 *           @OA\Property(
 *                         property="id",
 *                         type="string",
 *                         example="1"
 *                      ),
 *           @OA\Property(
 *                         property="name",
 *                         type="string",
 *                         example="qwe qweq qwe qwe"
 *                      ),
 *      ),
 * )
 */
    public $tests;


    public function __construct($tests = null)
    {
        $this->tests = $tests;

    }

    public function data()
    {
        return \response(json_encode($this))->setStatusCode(Response::HTTP_OK);
    }


}
