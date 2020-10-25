<?php

class Producto
{
    protected string $nombre;
    protected int $quantity;

    public function getNombre()
    {
        return $this->nombre;
    }
    
    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function __get(string $name)
    {
        if(!property_exists($this, $name))
        {
            die("La propiedad {$name} no existe.");
        }
        return $this->{$name};
    }
}

$producto = new Producto;
$producto->setNombre("Spike");
echo $producto->nombre;