<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

use App\Http\Requests\Auth\SignupRequest;
use App\Http\Responces\Auth\AuthLoginSuccessResponce;
use App\Http\Responces\Auth\AuthUserInfoSuccessResponce;
use App\Http\Responces\HttpSuccessResponce;
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
     *
     *   @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string",
     *           default="asdsad@qq.ee"
     *          )
     *      ),
     *     @OA\Parameter (
     *     name="name",
     *     in="query",
     *     required=true,
     *     @OA\Schema (
     *          type="string",
     *          default="Jimm"
     *          )
     *      ),
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
     *      description="Success",
     *      @OA\JsonContent(ref="#/components/schemas/AuthLoginSuccessResponce")
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
        $responce = new AuthLoginSuccessResponce($user,$user->createToken($request->email)->plainTextToken);

        return $responce->data();


    }


    /**
     * @OA\Get(
     *     path="/api/v1/auth/logout",
     *     tags={"Auth"},
     *     summary="LOGS OUT CURRENT LOGGED IN USER SESSION",
     *     operationId="logout",
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\Schema (ref="#/components/schemas/HttpSuccessResponce"),
     *
     *     ),
     *     security={
     *         {"sanctum": {}}
     *     },

     * )
     */

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        $responce = new HttpSuccessResponce();
        return $responce->data();
    }


    /**
     * @OA\Get(
     *     path="/api/v1/auth/user",
     *     tags={"Auth"},
     *     summary="LOGS OUT CURRENT LOGGED IN USER SESSION",
     *     operationId="getAuthenticatedUser",
     *     security={
     *         {"sanctum": {}}
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *              ref="#/components/schemas/AuthUserInfoSuccessResponce"
     *          )
     *     ),
     *      @OA\Response(
     *      response=404,
     *      description="not found fail",
     *      @OA\JsonContent (ref="#/components/schemas/HttpNotFoundResponce"),
     *   ),
     *     @OA\Response (
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *             ref="#/components/schemas/HttpUnauthenticatedResponce"
     *          ),
     *      ),
     *   @OA\SecurityScheme(
     *          securityScheme="Authorization",
     *          in="header",
     *          name="Authorization",
     *          type="http",
     *          scheme="bearer",
     *          bearerFormat="JWT",
     *      ),
     * )
     */
    public function getAuthenticatedUser(Request $request)
    {
        $return = new AuthUserInfoSuccessResponce($request->user());
        return $return->data();
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
