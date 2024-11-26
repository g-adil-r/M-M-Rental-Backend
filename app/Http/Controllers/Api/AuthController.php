<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => [
                    "code" => Response::HTTP_BAD_REQUEST,
                    "is_success" => false,
                ],
                "message" => "Validation Failed",
                "data" => $validator->errors(),
            ], Response::HTTP_BAD_REQUEST);
        }

        $credentials = $request->only('email', 'password');

        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                "status" => [
                    "code" => Response::HTTP_BAD_REQUEST,
                    "is_success" => false,
                ],
                "message" => "Unauthorized",
                "data" => null,
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            "status" => [
                "code" => Response::HTTP_OK,
                "is_success" => true,
            ],
            "message" => "Success",
            "data" => [
                "token" => $token,
                "token_type" => "bearer",
                "user" => auth()->guard('api')->user()
            ],
        ], Response::HTTP_OK);
    }

    public function logout(Request $request) {
        $removeToken = JWTAuth::invalidate(JWTAuth::getToken());

        if ($removeToken) {
            return response()->json([
                "status" => [
                    "code" => 200,
                    "is_success" => true,
                ],
                "message" => "successfully logged out",
                "data" => null,
            ]);
        }
    }

    public function refresh() {
        return $this->respondWithToken(JWTAuth::refresh());
    }

    public function me() {
        try {
            $user = auth()->guard('api')->user();

            if (!$user) {
                return response()->json([
                    'status' => [
                        'code' => Response::HTTP_UNAUTHORIZED,
                        'is_success' => false,
                    ],
                    'message' => 'Unauthorized: User not found',
                    'data' => null,
                ], Response::HTTP_UNAUTHORIZED);
            }

            return response()->json([
                'status' => [
                    'code' => Response::HTTP_OK,
                    'is_success' => true,
                ],
                'message' => 'User retrieved successfully',
                'data' => $user,
            ], Response::HTTP_OK);

        } catch (TokenExpiredException $e) {
            return response()->json([
                'status' => [
                    'code' => Response::HTTP_UNAUTHORIZED,
                    'is_success' => false,
                ],
                'message' => 'Unauthorized: Token has expired',
                'data' => null,
            ], Response::HTTP_UNAUTHORIZED);

        } catch (TokenInvalidException $e) {
            return response()->json([
                'status' => [
                    'code' => Response::HTTP_UNAUTHORIZED,
                    'is_success' => false,
                ],
                'message' => 'Unauthorized: Token is invalid',
                'data' => null,
            ], Response::HTTP_UNAUTHORIZED);

        } catch (JWTException $e) {
            return response()->json([
                'status' => [
                    'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'is_success' => false,
                ],
                'message' => 'An error occurred while parsing the token',
                'data' => null,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function respondWithToken($token) {
        return response()->json([
            "status" => [
                "code" => 200,
                "is_success" => true,
            ],
            "message" => "Success",
            "data" => [
                "token" => $token,
                "token_type" => "bearer",
                "expires_in" => JWTAuth::factory()->getTTL() * 60,
                "user" => Auth::user(),
            ],
        ]);
    }
}
