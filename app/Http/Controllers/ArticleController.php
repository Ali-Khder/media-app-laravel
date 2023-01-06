<?php

namespace App\Http\Controllers;

use App\Http\Traits\ResponseTrait;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    use ResponseTrait;

    /**
     * The auth service implementation.
     *
     * @var ArticleService
     */
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index()
    {
        return $this->articleService->getAll();
    }

    public function store(Request $request)
    {
        return $this->articleService->newArticle($request);
    }
}
