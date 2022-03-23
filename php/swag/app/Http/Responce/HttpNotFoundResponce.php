<?php

namespace App\Http\Responce;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Schema(
 *     title="HttpNotFoundResponce",
 *     description="HttpNotFoundResponce",
 * )
 */
class HttpNotFoundResponce
{
    public function __construct()
    {
    }

    public function data()
    {
        return \response(json_encode($this))->setStatusCode(Response::HTTP_NOT_FOUND);
    }


}
