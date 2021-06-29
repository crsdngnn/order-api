<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Service\Register\RegisterService;


class UserAuthController extends Controller
{

	private RegisterService $service;

    public function __construct(RegisterService $service)
    {
        $this->service = $service;
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }


    public function register(RegisterRequest $request)
    {
        $data = $request->all();
        $this->service->register($data);
        return response()->json(['message' => 'User Successfully Registered'], 401);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token
        ]);
    }
}
