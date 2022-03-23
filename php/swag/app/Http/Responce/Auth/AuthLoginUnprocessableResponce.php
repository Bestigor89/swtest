<?php

namespace App\Http\Responce\Auth;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;



/**
 * @OA\Schema(
 *     title="AuthLoginUnprocessableResponce",
 *     description="AuthLoginUnprocessableResponce",
 * )
 */
class AuthLoginUnprocessableResponce
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
