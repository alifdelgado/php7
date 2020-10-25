<?php

namespace App\Persistences;

use App\Models\Article;
use App\Interfaces\ArticleInterface;

class ArticleMemory implements ArticleInterface
{
    protected array $articles;

    public function __construct()
    {
        $this->articles = [
            1 => new Article(1, 'title 1', 'Contenido articulo 1'),
            2 => new Article(2, 'title 2', 'Contenido articulo 2'),
            3 => new Article(3, 'title 3', 'Contenido articulo 3'),
            4 => new Article(4, 'title 4', 'Contenido articulo 4'),
        ];
    }

    public function getArticle(int $id)
    {
        return $this->articles[$id];
    }

    public function getArticles()
    {
        return $this->articles;
    }
}