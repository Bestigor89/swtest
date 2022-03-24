<?php

namespace App\Http\Responce\Auth;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;
//{
//    "user": {
//    "id": 1,
//    "name": "Jimm",
//    "email": "asdsad@qq.ee",
//    "email_verified_at": null,
//    "created_at": "2022-03-22T09:35:10.000000Z",
//    "updated_at": "2022-03-22T09:35:10.000000Z"
//  },
//  "access_token": "19|i8o8cUTUqNHawTjzb2LjMXihW0ieyzF2Y9cUosE5",
//  "test": {
//    "name": "AuthToken",
//    "abilities": [
//        "*"
//    ],
//    "tokenable_id": 1,
//    "tokenable_type": "App\\Models\\User",
//    "updated_at": "2022-03-23T15:11:12.000000Z",
//    "created_at": "2022-03-23T15:11:12.000000Z",
//    "id": 20
//  }
//}

/**
 * @OA\Schema(
 *     title="AuthLoginSuccessResponce",
 *     description="AuthLoginSuccessResponce",
 * )
 */
class AuthLoginSuccessResponce
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

    /**
     * @OA\Property(
     *     title="access_token",
     *     description="access",
     *     format="string",
     *     example="19|i8o8cUTUqNHawTjzb2LjMXihW0ieyzF2Y9cUosE5"
     * )
     */
    public $access_token;



    public function __construct($user, $access_token)
    {
        $this->user = $user;
        $this->access_token = $access_token;
    }

    public function data()
    {
        return \response(json_encode($this))->setStatusCode(Response::HTTP_OK);
    }


}
