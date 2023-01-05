<?php

namespace App\Http\Controllers;

use App\Http\Traits\ResponseTrait;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ResponseTrait;

    /**
     * The auth service implementation.
     *
     * @var AuthService
     */
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(Request $request)
    {
        return $this->authService->register($request);
    }

    public function login(Request $request)
    {
        return $this->authService->login($request);
    }

    public function logout(Request $request)
    {
        return $this->authService->logout($request);
    }

    public function checkAuth()
    {
        return response("You are authenticated", 200);
    }
}
