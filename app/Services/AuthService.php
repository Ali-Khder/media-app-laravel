<?php

namespace App\Services;

use App\Http\Traits\ResponseTrait;
use App\Models\User;
use App\Services\Validations\AuthValidationService;
use Illuminate\Http\Request;

class AuthService
{
    use ResponseTrait;

    /**
     * The validation auth service implementation.
     *
     * @var AuthValidationService
     */
    protected $authValidationService;

    public function __construct(AuthValidationService $authValidationService)
    {
        $this->authValidationService = $authValidationService;
    }

    public function register(Request $request)
    {
        $validator = $this->authValidationService->register($request);
        if (!$validator->fails()) {
            $user = User::create([
                'name' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            $token = $user->createToken('RegirterToekn')->accessToken;
            $response = [
                'user' => $user,
                'token' => $token
            ];
            return $this->myresponse(true, 'Register Success', $response);
        } else {
            return $this->myresponse(false, $validator->errors()->first());
        }
    }

    public function login(Request $request)
    {
        $validator = $this->authValidationService->login($request);
        if (!$validator->fails()) {
            $data = [
                'email' => $request->email,
                'password' => $request->password
            ];
            if (auth()->attempt($data)) {
                $user = User::find(auth()->user()->id);
                $token = $user->createToken('LoginToken')->accessToken;
                $response = [
                    'user' => $user,
                    'token' => $token
                ];
                return $this->myresponse(true, 'Login success', $response);
            } else
                return $this->myresponse(false, 'Password is wrong');
        } else {
            return $this->myresponse(false, $validator->errors()->first());
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return $this->myresponse(true, 'Logut sucess');
    }
}
