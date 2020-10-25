<?php

$container = require __DIR__ . "/app/bootstrap.php";
$entityManager = $container->get(\App\Services\Doctrine::class)->em;
return new \Symfony\Component\Console\Helper\HelperSet(array(
    'em'    =>  new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($entityManager)
));