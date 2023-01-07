<?php

namespace App\Services;

use App\Http\Traits\ResponseTrait;
use App\Models\Article;
use App\Models\Gif;
use App\Models\User;
use App\Services\Validations\ArticleValidationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
        return $this->myresponse(
            true,
            'Articles',
            Article::all()->map(function ($article) {
                $article->user;
                return $article;
            })
        );
    }

    public function getMyArticles()
    {
        $user = User::find(auth()->user()->id);
        return $this->myresponse(
            true,
            'Articles',
            $user->articles()->paginate(6)
        );
    }

    public function findByTitle($title)
    {
        $article = Article::where('title', $title)->first();
        return $this->myresponse(
            true,
            'Article',
            $article
        );
    }

    public function newArticle(Request $request)
    {
        $validator = $this->articleValidationService->store($request);
        if (!$validator->fails()) {
            $author = User::find(auth()->user()->id);
            $article = $author->articles()->create([
                'title' => $request->title,
                'text' => $request->text
            ]);
            return $this->myresponse(true, 'Storing article Success', $article);
        } else {
            return $this->myresponse(false, $validator->errors()->first());
        }
    }

    public function uploadGifs(Request $request, $id)
    {
        $article = Article::find($id);
        if ($article === null)
            return $this->myresponse(false, "article not found");

        $gifs = $request->get('gif');
        foreach ($gifs as $gif) {
            $fileContents = file_get_contents($gif);
            $name = time() . "_gifs_images.gif";
            if (!File::exists("gifs")) {
                File::makeDirectory("gifs");
            }
            $path = public_path() . '/gifs/' . $name;
            File::put($path, $fileContents);
            $store = '/gifs/' . $name;
            $article->gifs()->create([
                "path" => $store
            ]);
        }
        return $this->myresponse(true, "Sucess");
    }
}
