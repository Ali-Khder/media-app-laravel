<?php

namespace App\Services\Validations;

use Illuminate\Http\Request;

class ArticleValidationService extends BaseValidationService
{

    public function store(Request $request)
    {
        return $this->validate($request, [
            'title' => 'required|string|min:5|max:25',
            'text' => 'required|string|min:5|max:4000'
        ]);
    }
}
