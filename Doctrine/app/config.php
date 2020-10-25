<?php

use Twig\Environment;
use App\Services\Doctrine;
use Twig\Loader\FilesystemLoader;

return [
    Environment::class => function () {
        $loader = new FilesystemLoader(__DIR__ . "/Views/");
        $twig = new Environment($loader, [
            "debug" =>  true
        ]);
        $twig->addExtension(new \Twig\Extension\DebugExtension());
        return $twig;
    },
    Doctrine::class => \DI\create(Doctrine::class)
        ->constructor(\DI\get('db.connectionOptions')),
        'db.connectionOptions'  =>  [
            "driver"        =>  "pdo_mysql",
            "host"          =>  "127.0.0.1",
            "user"          =>  "root",
            "password"      =>  '',
            "post"          =>  8889,
            "dbname"        =>  "doctrinedb"
        ]
];