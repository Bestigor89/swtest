<?php

namespace App\Http\Responce\Auth;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

//
//{
//    "user": {
//    "id": 1,
//    "name": "Jimm",
//    "email": "asdsad@qq.ee",
//    "email_verified_at": null,
//    "created_at": "2022-03-22T09:35:10.000000Z",
//    "updated_at": "2022-03-22T09:35:10.000000Z"
//  },
//  "access_token": "17|LSh06zSt7fxap3eNIkC9wYppWNCs4uAyVWPzgqr6",
//  "test": {
//    "name": "AuthToken",
//    "abilities": [
//        "*"
//    ],
//    "tokenable_id": 1,
//    "tokenable_type": "App\\Models\\User",
//    "updated_at": "2022-03-23T10:56:45.000000Z",
//    "created_at": "2022-03-23T10:56:45.000000Z",
//    "id": 18
//  }
//}

/**
 * @OA\Schema(
 *     title="AuthSignupSuccessResponce",
 *     description="AuthSignupSuccessResponce",
 * )
 */
class AuthSignupSuccessResponce
{
    /**
     * @OA\Property(
     *     title="status",
     *     description="Success created user",
     *     format="string",
     *     example="success"
     * )
     */
    public $status = "success";


    public function __construct()
    {

    }

    public function data()
    {
        return \response(json_encode($this))->setStatusCode(Response::HTTP_CREATED);
    }


}
