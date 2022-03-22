<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowTestRequest;
use App\Http\Requests\StoreTestRequest;
use App\Http\Resources\Test;
use App\Http\Responce\Test\TestSuccessResponce;
use App\Http\Responce\Test\TestUpdateResponce;
use Faker\Factory;
use Symfony\Component\HttpFoundation\Response;

class TestController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/v1/test",
     *      operationId="getProjectsList",
     *      tags={"Tests"},
     *      summary="Get list of test",
     *      description="Returns list of test",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function index()
    {
        //
        $faker = Factory::create();
        for($i=0;$i<20;$i++) {
            $data[] = [ $faker->text(), $faker->numberBetween(0,100)];
        }
        return new Test($data);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/test",
     *      operationId="storeTest",
     *      tags={"Tests"},
     *      summary="Store new Test",
     *      description="Returns Test data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreTestRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function store(StoreTestRequest $request)
    {
        $validated = $request->validate();

        $faker = Factory::create();
        $data = [ $request->json()->all()['name'], $faker->numberBetween(0,100)];
        return (new Test($data))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/test/{id}/",
     *      operationId="getTestById",
     *      tags={"Tests"},
     *      summary="Get Test information",
     *      description="Returns Test data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Test id",
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
     *         @OA\JsonContent (ref="#/components/schemas/TestSuccessResponce"),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function show($id)
    {
        $faker = Factory::create();
        $responce = new TestSuccessResponce($id,$faker->text);

        return $responce->data();

    }

    /**
     * @OA\Put  (
     *      path="/api/v1/test/{id}/",
     *      operationId="UpdateById",
     *      tags={"Tests"},
     *      summary="Update Test information",
     *      description="Update Test data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\Schema (ref="#/components/schemas/StoreTestRequest")
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          description="Test id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              default=1,
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     * )
     */
    public function update(StoreTestRequest $request, $id)
    {
        $validated = $request->validate();
        $faker = Factory::create();
        $data = [ $request->json()->all()['name'], $faker->numberBetween(0,100)];
        $responce = new TestUpdateResponce($request->json()->all()['name'],$id);
        return $responce;

    }

    /**
     * @OA\Delete (
     *      path="/api/v1/test/{id}/",
     *      operationId="deleteById",
     *      tags={"Tests"},
     *      summary="Delete Test information",
     *      description="Delete Test data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Test id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              default=1,
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     * )
     */
    public function destroy($id)
    {
        return Response::HTTP_OK;
    }
}
