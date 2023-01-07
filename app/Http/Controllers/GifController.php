<?php

namespace App\Http\Controllers;

use App\Http\Traits\ResponseTrait;
use App\Services\GifService;
use Illuminate\Http\Request;

class GifController extends Controller
{
    use ResponseTrait;

    // search gifs service
    private $gifService;

    public function __construct(GifService $gifService)
    {
        $this->gifService = $gifService;
    }

    public function search(Request $request)
    {
        return $this->gifService->searchGifs(
            $request->content,
            $request->limit
        );
    }
}
