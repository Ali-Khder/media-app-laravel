<?php

namespace App\Services;

use App\Http\Traits\ResponseTrait;
use App\Models\Article;
use App\Services\Validations\ArticleValidationService;
use Illuminate\Http\Request;

class ArticleService
{
    use ResponseTrait;

    /**
     * The validation auth service implementation.
     *
     * @var ArticleValidationService
     */
    protected $articleValidationService;

    public function __construct(ArticleValidationService $articleValidationService)
    {
        $this->articleValidationService = $articleValidationService;
    }

    public function getAll()
    {
        return $this->myresponse(true, 'Articles', Article::paginate(6));
    }

    public function newArticle(Request $request)
    {
        $validator = $this->articleValidationService->store($request);
        if (!$validator->fails()) {
            $article = Article::create([
                'title' => $request->title,
                'text' => $request->text
            ]);
            return $this->myresponse(true, 'Storing article Success', $article);
        } else {
            return $this->myresponse(false, $validator->errors()->first());
        }
    }
}
