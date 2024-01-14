<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:100',
            'surname' => 'required|string',
            'role' => 'required|string',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'required|string',
            'avatar' => 'required|string',
            'status' => 'required|string',

        ];
        $validator = Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'errors' => $validator->errors()->all()
                ],
                400
            );
        }
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'avatar' => $request->avatar,
            'status' => $request->status
        ]);
        return response()->json(
            [
                'status' => true,
                'message' => 'User created successfully',
                'token' => $user->createToken('API TOKEN')->plainTextToken
            ],
            200
        );
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                'email' => 'required|string|email|max:100',
                'password' => 'required|string'
            ];
            $validator = Validator::make($request->input(), $rules);
            if ($validator->fails()) {
                return response()->json(
                    [
                        'status' => false,
                        'errors' => $validator->errors()->all()
                    ],
                    400
                );
            }
            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json(
                    [
                        'status' => false,
                        'errors' => ['Unauthorized']
                    ],
                    401
                );
            }
            $user = User::where('email', $request->email)->select(
                "id",
                "name",
                "surname",
                "role",
                "email",
                "phone",
                "avatar",
                "status"
            )->first();
            return response()->json(
                [
                    'status' => true,
                    'message' => 'User logged in successfully',
                    'data' => $user,
                    'token' => $user->createToken('API TOKEN')->plainTextToken
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        };
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => true,
            'message' => 'User logged out successfully'
        ], 200);
    }
}
