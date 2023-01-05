<?php

namespace App\Services\Validations;

use App\Http\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BaseValidationService
{
    protected function validate(Request $request, $rules)
    {
        $validator = Validator::make($request->all(), $rules);
        return $validator;
    }
}
