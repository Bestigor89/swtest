<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
/**
 * @OA\Schema(
 *      title="Login Request request",
 *      description="Reqest for auth users request body data",
 *      type="object",
 *      required={"email", "password"}
 * )
 */
class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @OA\Property(
     *      title="email",
     *      description="email for login",
     *      example="asdsad@qq.ee"
     * ),
     */
    private $email;
    /**
     * @OA\Property(
     *      title="password",
     *      description="Username password",
     *      example="demo1234"
     * ),
     *
     */
    private $password;


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'email'    => 'required|email',
            'password' => 'required',
        ];
    }
}
