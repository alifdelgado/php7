<?php

namespace App\Services;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Doctrine
{
    public $em = null;

    public function __construct(array $connectionOptions)
    {
        $paths = [
            rtrim(__DIR__ . "/../Repositories"),
            rtrim(__DIR__ . "/../Entities"),
        ];

        $isDevMode = true;

        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
        $this->em = EntityManager::create($connectionOptions, $config);
    }
}