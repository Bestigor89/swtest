<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
/**
 * @OA\Schema(
 *      title="Store Test request",
 *      description="Store Test request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class StoreTestRequest extends FormRequest
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
     * @var string
     */
    public $name;

    public function validator(){
        $data = json_decode($this->instance()->getContent(),true);

        return \Validator::make($data, [
            'name' => 'required'
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
