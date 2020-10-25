<?php

class Logger
{
    public function message(Shop $shop)
    {
        print_r($shop->getMessage());
    }
}

class Shop
{
    protected Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function getMessage(): string
    {
        return "Nuevo mensaje";
    }

    public function __call($name, $arguments)
    {
        if(method_exists($this->logger, $name))
        {
            return $this->logger->{$name}($this);
        }

        echo "El método {$name} no existe en la clase " . get_class($this->logger);
    }
}

$shop = new Shop(new Logger());
echo $shop->other() . "\n\n";

class User
{
    public function __call($name, $arguments)
    {
        echo $name . ': ' . implode(', ', $arguments) . PHP_EOL;
    }
    public function bonus($amount)
    {
        echo 'bonus: ' . $amount . PHP_EOL;
    }
}
$user = new User();
$user->hello('John', 34);
$user->bonus(560.00);
$user->salary(4200.00);