<?php

namespace App\Controllers;

use Twig\Environment;
use App\Interfaces\ArticleInterface;

class HomeController
{
    /**
     * @var Environment $twig
     */
    protected Environment $twig;

    /**
     * @var ArticleInterface $repository
     */
    protected ArticleInterface $repository;
    
    /**
     * Constructor function
     *
     * @param Environment $twig
     * @param ArticleInterface $repository
     */
    public function __construct(Environment $twig, ArticleInterface $repository)
    {
        $this->twig = $twig;
        $this->repository = $repository;
    }

    public function index()
    {
        echo "hola desde el home controller";
    }

    public function articulos()
    {
        echo $this->twig->render('home.twig', [
            "articles"  =>  $this->repository->getArticles()
        ]);
    }

    public function articulo(int $id)
    {
        $article = $this->repository->getArticle($id);
        var_dump($article);
    }
}