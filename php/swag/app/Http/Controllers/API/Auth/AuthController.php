<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\Auth\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    /**
     * @param SignupRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @OA\Post(
     ** path="/api/v1/auth/signup",
     *   tags={"Auth"},
     *   summary="Signup",
     *   operationId="Signup",
     *  *      @OA\RequestBody(
     *          required=true,
     *           @OA\JsonContent(ref="#/components/schemas/SignupRequest")
     *      ),
     *   @OA\Parameter(
     *      name="email",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="string",
     *           default="asdsad@qq.ee"
     *          )
     *      ),
     *     @OA\Parameter (
     *     name="name",
     *     in="path",
     *     required=true,
     *     @OA\Schema (
     *          type="string",
     *          default="Jimm"
     *          )
     *      ),
     *   @OA\Parameter(
     *      name="password",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *          default="demo1234"
     *      )
     *   ),
     *   @OA\Response(
     *      response=201,
     *       description="Success Create user",
     *      @OA\JsonContent (ref="#/components/schemas/AuthSignupSuccessResponce"),
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found fail",
     *      @OA\JsonContent (ref="#/components/schemas/HttpNotFoundResponce"),
     *   ),
     * @OA\Response(
     *      response=422,
     *      description="The given data was invalid.",
     *      @OA\JsonContent (ref="#/components/schemas/AuthLoginUnprocessableResponce"),
     *   ),
     *)
     *
     */

    public function signup(SignupRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['password'] = Hash::make($validatedData['password']);

        if (User::create($validatedData)) {
            return response()->json(['status' => 'success'], Response::HTTP_CREATED);
        }

        return response()->json(['status' => 'fail'], Response::HTTP_NOT_FOUND);
    }
    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    /**
     * @OA\Post(
     *   path="/api/v1/auth/login",
     *   tags={"Auth"},
     *   summary="Login",
     *   operationId="login",
     *   @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *      ),
     *   @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string",
     *           default="asdsad@qq.ee"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *          default="demo1234"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found",
     *      @OA\JsonContent(ref="#/components/schemas/HttpNotFoundResponce")
     *   ),
     *     @OA\Response(
     *      response=422,
     *      description="not found",
     *      @OA\JsonContent(ref="#/components/schemas/AuthLoginUnprocessableResponce")
     *   ),
     *
     *)
     **/
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                                                        'email' => ['The provided credentials are incorrect.'],
                                                    ]);
        }


        return response()->json(
            [
                'user'         => $user,
                'access_token' => $user->createToken($request->email)->plainTextToken,
                'test' => $user->createToken('AuthToken')->accessToken,
            ],
            Response::HTTP_OK
        );
    }


    /**
     * @OA\Get(
     *     path="/api/v1/auth/logout",
     *     tags={"Auth"},
     *     summary="LOGS OUT CURRENT LOGGED IN USER SESSION",
     *     operationId="logout",
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *
     *     ),
     *     security={
     *         {"bearer": {}}
     *     }
     * )
     */

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(null, Response::HTTP_OK);
    }


    /**
     * @OA\Get(
     *     path="/api/v1/auth/user",
     *     tags={"Auth"},
     *     summary="LOGS OUT CURRENT LOGGED IN USER SESSION",
     *     operationId="getAuthenticatedUser",
     *     @OA\SecurityScheme (
     *              securityScheme="bearerAuth",
     *              type="http",
     *              scheme="bearer"
     *              ),
     *     @OA\Parameter(
     *         name="Authorization",
     *         in="header",
     *         required=true,
     *         description="Bearer {access-token}",
     *         @OA\Schema(
     *              type="bearerAuth"
     *         )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     security={
     *         {"bearer": {}}
     *     }
     * )
     */
    public function getAuthenticatedUser(Request $request)
    {
        var_dump("asdada");
        die();
        return $request->user();
    }


    public function sendPasswordResetLinkEmail(Request $request)
    {
//        $request->validate(['email' => 'required|email']);
//
//        $status = Password::sendResetLink(
//            $request->only('email')
//        );
//
//        if ($status === Password::RESET_LINK_SENT) {
//            return response()->json(['message' => __($status)], 200);
//        } else {
//            throw ValidationException::withMessages([
//                                                        'email' => __($status)
//                                                    ]);
//        }
    }

    public function resetPassword(Request $request)
    {
//        $request->validate([
//                               'token'    => 'required',
//                               'email'    => 'required|email',
//                               'password' => 'required|min:8|confirmed',
//                           ]);
//
//        $status = Password::reset(
//            $request->only('email', 'password', 'password_confirmation', 'token'),
//            function ($user, $password) use ($request) {
//                $user->forceFill([
//                                     'password' => Hash::make($password)
//                                 ])->setRememberToken(Str::random(60));
//
//                $user->save();
//
//                event(new PasswordReset($user));
//            }
//        );
//
//        if ($status == Password::PASSWORD_RESET) {
//            return response()->json(['message' => __($status)],  Response::HTTP_OK);
//        } else {
//            throw ValidationException::withMessages([
//                                                        'email' => __($status)
//                                                    ]);
//        }
    }
}
