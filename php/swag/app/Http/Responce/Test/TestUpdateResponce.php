<?php

namespace App\Http\Responce\Test;

use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class TestUpdateResponce
{

    public $id;
    public $name;
    public $status;

    public function __construct($id = null, $name = null, $status = 'success' )
    {
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
    }

    public function data()
    {
        return \response(json_encode($this))->setStatusCode(Response::HTTP_CREATED);
    }


}
