<?php

trait Cart
{
    protected array $cart = [];
}

trait Session
{
    public function login(): string
    {
        return "Has iniciado sesión"; 
    }
}

class User
{
    use Cart, Session;

    public function getCart()
    {
        return $this->cart;
    }
}

$user = new User;
var_dump($user);
var_dump($user->getCart());
var_dump($user->login());