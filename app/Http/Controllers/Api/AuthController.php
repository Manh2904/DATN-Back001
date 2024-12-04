<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\ApiRegisterRequest;
use App\Http\Requests\ApiChangePassWordRequest;
use App\Http\Requests\ApiUpdateRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'getEmailReset']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return JsonResponse
     */
    public function login(ApiLoginRequest $request)
    {
        $data = $request->only('email', 'password');
        if (!auth('api')->attempt($data)) {
            return response()->json(['error' => 'Sai tài khoản hoặc mật khẩu'], 400);
        }
        $token = $this->createNewToken(auth('api')->attempt($data))->original;
        return response()->json([
            'status' => 'success',
            'token' => $token['access_token'],
            'user' => auth('api')->user(),
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60000
        ], 200);
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'status' => 'success',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth('api')->user()
        ]);
    }

    /**
     * Register a User.
     *
     * @return JsonResponse
     */
    public function register(ApiRegisterRequest $request)
    {
        $data = $request->all();
        $user = User::create(array_merge(
            $data,
            ['password' => bcrypt($request->password)]
        ));
        $token = JWTAuth::fromUser($user);
        JWTAuth::setToken($token)->getPayload();
        $parseToken = JWTAuth::getPayload($token)->toArray();
        return response()->json([
            'status' => 'success',
            'message' => 'User successfully registered',
            'user' => $user,
            'access_token' => $token,
            'expires_in' => $parseToken['exp'],
        ], 201);
    }

    public function update(ApiUpdateRequest $request)
    {
        $user = User::find( auth('api')->user()->id);
        $data = $request->except('_token');
        $data['updated_at'] = Carbon::now();
        $user->update($data);
        return response()->json([
            'status' => 'success',
            'data' => auth('api')->user()
        ], 201);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(auth('api')->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function profile()
    {
        return response()->json([
            'status' => 'success',
            'data' => auth('api')->user()
        ], 201);
    }

    public function changePassWord(ApiChangePassWordRequest $request)
    {
        if (!Hash::check($request->old_password, auth('api')->user()->password)) {
            return response()->json([
                'error' => 'Mật khẩu cũ không đúng'
            ], 400);
        }
        $userId = auth('api')->user()->id;

        $user = User::where('id', $userId)->update(
            ['password' => bcrypt($request->password)]
        );

        return response()->json([
            'status' => 'success',
            'data' => auth('api')->user()
        ], 201);
    }

}
