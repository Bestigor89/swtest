<?php

namespace App\Http\Responce;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Schema(
 *     title="HttpForbiddenResponce",
 *     description="HttpForbiddenResponce",
 * )
 */
class HttpForbiddenResponce
{
    public function __construct()
    {
    }

    public function data()
    {
        return \response(json_encode($this))->setStatusCode(Response::HTTP_FORBIDDEN);
    }


}
