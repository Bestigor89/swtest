<?php

namespace App\Http\Requests\Test;

use Illuminate\Foundation\Http\FormRequest;
/**
 * @OA\Schema(
 *      title="Update Test request",
 *      description="Update Test request body data",
 *      type="object",
 *      required={"name"}
 * )
 */

class UpdateTestRequest extends FormRequest
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
     *      description="Name of the new Test",
     *      example="First Test"
     * )
     *
     *
     */
    public $name;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
