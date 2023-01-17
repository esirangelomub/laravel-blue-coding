<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\TokenRequest;
use App\Jobs\SendEmailJob;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller
{
    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create($request->all());

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => "Register successfully!",
            'data' => [
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]
        ], ResponseAlias::HTTP_CREATED);
    }

    /**
     * @param TokenRequest $request
     * @return JsonResponse
     * @throws AuthenticationException
     */
    public function token(TokenRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            throw new AuthenticationException('Invalid login details');
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => "Token successfully!",
            'data' => [
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * @return JsonResponse
     */
    public function email(): JsonResponse
    {
        SendEmailJob::dispatch(request()->user());

        return response()->json([
            'status' => true,
            'message' => "Email's sent successfully!",
            'data' => null
        ], ResponseAlias::HTTP_OK);
    }
}
