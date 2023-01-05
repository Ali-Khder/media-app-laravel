<?php

namespace App\Services\Validations;

use Illuminate\Http\Request;

class AuthValidationService extends BaseValidationService
{

    public function register(Request $request)
    {
        return $this->validate($request, [
            'username' => 'required|string|min:5',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|max:25'
        ]);
    }

    public function login(Request $request)
    {
        return $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|max:25'
        ]);
    }
}
