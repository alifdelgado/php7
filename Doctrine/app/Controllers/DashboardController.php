<?php

namespace App\Controllers;

use Twig\Environment;
use App\Services\Doctrine;

class DashboardController
{
    /**
     * Environment $twig
     */
    private Environment $twig;

    /**
     * @var Doctrine $doctrine
     */
    private Doctrine $doctrine;

    /**
     * construct function
     *
     * @param Environment $twig
     * 
     * @param Doctrine $doctrine
     */
    public function __construct(Environment $twig, Doctrine $doctrine)
    {
        $this->twig = $twig;
        $this->doctrine = $doctrine;

        if(!isset($_SESSION['user_id']))
        {
            redirectTo("/login");
            exit;
        }
    }

    /**
     * index function
     *
     * @return void
     */
    public function index()
    {
        echo $this->twig->render('app/dashboard.twig', [
            "session"   =>  $_SESSION
        ]);
    }
}