<?php

namespace App\Http\Responces\Label;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Schema(
 *     title="LabelSuccessResponce",
 *     description="LabelSuccessResponce",
 * )
 */
class LabelSuccessResponce
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
    /**
     * @OA\Property(
     *     title="status",
     *     description="status",
     *     format="bool",
     *     example="true"
     * )
     */
    public $status;

    public function __construct($id = null, $name = null, $status=null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;

    }

    public function data()
    {
        return \response(json_encode($this))->setStatusCode(Response::HTTP_OK);
    }


}
