<?php

namespace App\Interfaces;

interface ArticleInterface
{
    public function getArticle(int $id);
    public function getArticles();
}