<?php

namespace App\Http\Requests\Label;

use Illuminate\Foundation\Http\FormRequest;
/**
 * @OA\Schema(
 *      title="Store Label request",
 *      description="Store Label request body data",
 *      type="object",
 *      required={"name","status"}
 * )
 */
class StoreLabelRequest extends FormRequest
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
     *      description="Name of the new Label",
     *      example="Green"
     * )
     *
     *
     */
    public $name;
    /**
     * @OA\Property(
     *      title="status",
     *      description="Status Label enabled or no ",
     *      example="true"
     * )
     *
     *
     */
    public $status;

    public function validator(){
        $data = json_decode($this->instance()->getContent(),true);

        return \Validator::make($data, [
            'name'  => 'required',
            'status' => 'required'
        ], $this->messages(), $this->attributes());
    }
    public function validate(){
        $instance = $this->getValidatorInstance();
        if(!$instance->passes()){
            $this->failedValidation($instance);
        }elseif( $instance->passes()){
            if($this->ajax())
                throw new HttpResponseException(response()->json(['success' =>          true]));
        }
    }

}
