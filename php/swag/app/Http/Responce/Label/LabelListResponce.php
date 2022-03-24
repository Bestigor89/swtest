<?php

namespace App\Http\Responce\Label;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Schema(
 *     title="LabelListResponce",
 *     description="LabelListResponce",
 * )
 */
class LabelListResponce
{
/**
 * @OA\Property(
 *     title="Labels[]",
 *     description="array of Labels",
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
 *                         example="Red"
 *                      ),
 *           @OA\Property(
 *                         property="status",
 *                         type="bool",
 *                         example="true"
 *                      ),
 *      ),
 * )
 */
    public $labels;


    public function __construct($labels = null)
    {
        $this->labels = $labels;

    }

    public function data()
    {
        return \response(json_encode($this))->setStatusCode(Response::HTTP_OK);
    }


}
