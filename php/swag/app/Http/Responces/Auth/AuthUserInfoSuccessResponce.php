<?php

namespace App\Http\Responces\Auth;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

//{
//    "id": 1,
//  "name": "Jimm",
//  "email": "asdsad@qq.ee",
//  "email_verified_at": null,
//  "created_at": "2022-03-22T09:35:10.000000Z",
//  "updated_at": "2022-03-22T09:35:10.000000Z"
//}
/**
 * @OA\Schema(
 *     title="AuthUserInfoSuccessResponce",
 *     description="AuthUserInfoSuccessResponce",
 * )
 */
class AuthUserInfoSuccessResponce
{
    /**
     * @OA\Property(
     *     title="user",
     *     description="user informations",
     *     type="array",
     *     @OA\Items(
     *          @OA\Property (
     *              property="id",
     *              format="int64",
     *              example="1"
     *          ),
     *     @OA\Property (
     *              property="name",
     *              format="string",
     *              example="Jimm"
     *          ),
     *     @OA\Property (
     *              property="email",
     *              format="string",
     *              example="asdsad@qq.ee"
     *          ),
     *     @OA\Property (
     *              property="email_verified_at",
     *              format="string",
     *              example="null"
     *          ),
     *     @OA\Property (
     *              property="created_at",
     *              format="string",
     *              example="2022-03-22T09:35:10.000000Z"
     *          ),
     *     @OA\Property (
     *              property="updated_at",
     *              format="string",
     *              example="2022-03-22T09:35:10.000000Z"
     *          ),
     *      ),
     * ),
     */
    public $user;





    public function __construct($user)
    {
        $this->user = $user;

    }

    public function data()
    {
        return \response(json_encode($this))->setStatusCode(Response::HTTP_OK);
    }


}
