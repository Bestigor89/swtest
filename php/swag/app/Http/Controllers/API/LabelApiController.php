<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;

use App\Http\Requests\Label\StoreLabelRequest;
use App\Http\Responce\Label\LabelListResponce;
use App\Http\Responce\Label\LabelSuccessResponce;
use App\Http\Responce\Label\LabelUpdateResponce;

use Faker\Factory;
use Illuminate\Http\Request;


class LabelApiController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/v1/label",
     *      operationId="getLabelList",
     *      tags={"Label"},
     *      summary="Get list of Label",
     *      description="Returns list of Label",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent (ref="#/components/schemas/LabelListResponce"),
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent (ref="#/components/schemas/HttpUnauthenticatedResponce"),
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent (ref="#/components/schemas/HttpForbiddenResponce"),
     *      )
     *     )
     */
    public function index()
    {

        $faker = Factory::create();
        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                'name'=>$faker->text(50),
                'id' => $faker->numberBetween(0, 100),
                'status' => $faker->boolean
            ];
        }

        $responce = new LabelListResponce($data);

        return $responce->data();
    }
    /**
     * @OA\Post(
     *      path="/api/v1/label",
     *      operationId="storeLabel",
     *      tags={"Label"},
     *      summary="Store new Label",
     *      description="Store new Label",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreLabelRequest"),
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent (ref="#/components/schemas/LabelUpdateResponce"),
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\JsonContent (ref="#/components/schemas/HttpFailResponce"),
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent (ref="#/components/schemas/HttpForbiddenResponce"),
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Forbidden",
     *          @OA\JsonContent (ref="#/components/schemas/LabelUnprocessableResponce"),
     *      )
     *
     * )
     */
    public function store(StoreLabelRequest $request)
    {
        $validated = $request->validate();

        $faker = Factory::create();
        $data = [$request->json()->all()['name'], $faker->numberBetween(0, 100)];
        $responce = new LabelUpdateResponce($request->json()->all()['name'], $faker->numberBetween(0, 100), $faker->boolean());

        return $responce->data();
    }
    /**
     * @OA\Get(
     *      path="/api/v1/label/{id}/",
     *      operationId="getLabelById",
     *      tags={"Label"},
     *      summary="Get Label information",
     *      description="Returns Label data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Label id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              default=1,
     *          )
     *      ),
     *      @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent (ref="#/components/schemas/LabelSuccessResponce"),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\JsonContent (ref="#/components/schemas/HttpFailResponce"),
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent (ref="#/components/schemas/HttpForbiddenResponce"),
     *      )
     * )
     */
    public function show($id)
    {

        $faker = Factory::create();
        $responce = new LabelSuccessResponce($id, $faker->text, $faker->boolean);

        return $responce->data();
    }

    public function update(UpdateLabelRequest $request, Label $label)
    {
        $label->update($request->validated());

        return (new LabelResource($label))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Label $label)
    {
        abort_if(Gate::denies('label_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $label->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
