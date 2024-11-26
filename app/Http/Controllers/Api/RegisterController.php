<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|string|min:6',
            'phone_number' => 'required|string',
            'alamat' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => [
                    'code' => Response::HTTP_BAD_REQUEST,
                    'is_success' => false,
                ],
                'message' => 'Validation Failed',
                'data' => $validator->errors(),
            ], Response::HTTP_BAD_REQUEST);
        }

        $user = UserModel::create([
            'nama_user' => $request->name,
            'email' => $request->email,
            'password_hash' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'role_id' => 2,
            'alamat' => $request->alamat,
        ]);

        if ($user) {
            return response()->json([
                'status' => [
                    'code' => Response::HTTP_CREATED,
                    'is_success' => true,
                ],
                'message' => 'User created successfully',
                'data' => $user,
            ], Response::HTTP_CREATED);
        }

        return response()->json([
            'status' => [
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'is_success' => false,
            ],
            'message' => 'Failed to create user',
            'data' => null,
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
