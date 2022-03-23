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
 *     title="AuthLoginSuccessResponce",
 *     description="AuthLoginSuccessResponce",
 * )
 */
class AuthLoginSuccessResponce
{
    /**
     * @OA\Property(
     *     title="message",
     *     description="message of global error",
     *     format="string",
     *     example="The given data was invalid."
     * )
     */
    public $message = "The given data was invalid.";
    /**
     * @OA\Property(
     *     title="errors",
     *     description="message of errors",
     *     type="array",
     *     @OA\Items(
     *         @OA\Property (
     *               property="email",
     *               type="array",
     *                  @OA\Items(
     *                          @OA\Property (
     *                               format="string",
     *                              example="The provided credentials are incorrect.",
     *                              ),
     *                          ),
     *                      ),
     *              ),
     * )
     */
    public $errors = [
        'email'=> [
            "The provided credentials are incorrect."
        ],
    ];

    public function __construct()
    {

    }

    public function data()
    {
        return \response(json_encode($this))->setStatusCode(Response::HTTP_OK);
    }


}
