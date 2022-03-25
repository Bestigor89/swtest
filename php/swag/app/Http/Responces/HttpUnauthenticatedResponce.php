<?php

namespace App\Http\Responces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Schema(
 *     title="HttpUnauthenticatedResponce",
 *     description="HttpUnauthenticatedResponce",
 * )
 */
class HttpUnauthenticatedResponce
{
    public function __construct()
    {
    }

    /**
     * @OA\Property(
     *     title="message",
     *     description="message",
     *     format="string",
     *     example="Unauthenticated"
     * )
     */
    public $message;

    public function data()
    {
        return \response(json_encode($this))->setStatusCode(Response::HTTP_UNAUTHORIZED);
    }


}
