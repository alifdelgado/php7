<?php

use Twig\Environment;
use function DI\create;
use Twig\Loader\FilesystemLoader;
use App\Persistences\ArticleMemory;
use App\Interfaces\ArticleInterface;

return [
    ArticleInterface::class => create(ArticleMemory::class),
    Environment::class => function() {
        $loader = new FilesystemLoader(__DIR__ . "/views/");
        return new Environment($loader);
    }
];