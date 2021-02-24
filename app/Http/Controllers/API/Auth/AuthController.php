<?php
namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $model;

    public function register(Validator $request)
    {
        $user = User::make([
            'name' => $request->request()->name,
            'email' => $request->request()->email,
            'password' => Hash::make($request->request()->password),
        ]);

        $user->isManager = 0;
        $user->role_id = 2;

        if (isset($request->request()->isManager)) {
            $user->isManager = 1;
            $user->role_id = 1;
        }

        $user->save();

        return response()->json([
            'result' => true,
            'message' => 'Registration Successful. Please verify and log in to your account'
        ]);
    }

    public function login(Validator $request)
    {
        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials))
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ]);

        $user = $request->request()->user();

        $tokenResult = $user->createToken('Personal Access Token');

        return $this->loginSuccess($tokenResult, $user);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'result' => true,
            'message' => "Successfully logged out"
        ]);
    }

    protected function loginSuccess($tokenResult, $user)
    {
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addYear();
        $token->save();

        $data = [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]
        ];

        return response()->json([
            'result' => true,
            'data' => $data,
        ]);
    }

}
