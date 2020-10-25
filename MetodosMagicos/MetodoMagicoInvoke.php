<?php

class Blog
{
    public function __invoke(string $name)
    {
        echo "El nombre del blog en la clase " . __CLASS__ . " es {$name}\n";
    }
}

$blog = new Blog();
$blog("Mi blog");
var_dump(is_callable($blog));