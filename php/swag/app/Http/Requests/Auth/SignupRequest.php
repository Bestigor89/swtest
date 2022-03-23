<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
/**
 * @OA\Schema(
 *      title="Signup reqest",
 *      description="Create new account of user",
 *      type="object",
 *      required={"name", "email", "password" }
 * )
 */
class SignupRequest extends FormRequest
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
     *      title="name",
     *      description="Name of user",
     *      example="Name of user"
     * )
     *
     *
     */
    private $name ;

    /**
     * @OA\Property(
     *      title="email",
     *      description="User email ",
     *      example="qwe@mail.com"
     * )
     *
     *
     */
    private $email  ;
    /**
     * @OA\Property(
     *      title="password",
     *      description="Username password",
     *      example="demo1234"
     * )
     *
     *
     */
    private $password  ;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ];
    }
}
