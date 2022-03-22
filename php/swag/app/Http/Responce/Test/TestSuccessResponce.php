<?php

namespace App\Http\Responce\Test;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Schema(
 *     title="TestSuccessResponce",
 *     description="TestSuccessResponce",
 * )
 */
class TestSuccessResponce
{
/**
 * @OA\Property(
 *     title="ID",
 *     description="ID",
 *     format="int64",
 *     example=1
 * )
 */
    public $id;
    /**
     * @OA\Property(
     *     title="name",
     *     description="name",
     *     format="string",
     *     example="some name"
     * )
     */
    public $name;


    public function __construct($id = null, $name = null)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function data()
    {
        return \response(json_encode($this))->setStatusCode(Response::HTTP_OK);
    }


}
