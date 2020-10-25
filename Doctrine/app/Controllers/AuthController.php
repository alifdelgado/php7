<?php

namespace App\Controllers;

use Twig\Environment;
use App\Entities\User;
use App\Services\Doctrine;

class AuthController
{
    /**
     * @vr Environment $twig
     */
    protected Environment $twig;

    /**
     * @var Doctrine $doctrine
     */
    protected Doctrine $doctrine;

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
    }

    /**
     * login function
     *
     * @return void
     */
    public function login()
    {
        $post = [];
        $data = [];
        $errors = [];
        if(isset($_POST['submit']))
        {
            $password = NULL;
            
            if(empty($_POST['email']))
            {
                $errors[] = 'The email field is required';
            }
            
            if(empty($_POST['password']))
            {
                $errors[] = 'The password field is required';
            }
            
            $email = !empty($_POST['email']) ? $_POST['email'] : '';
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $errors[] = 'The email field has not a valid value';
            }

            if(empty($errors))
            {
                $password = filter_input(INPUT_POST, 'password');
                $user = $this->doctrine->em->getRepository(User::class)->findOneBy([
                    'email' =>  $email
                ]);

                if($user)
                {
                    if(password_verify($password, $user->getPassword()))
                    {
                        $data[] = [
                            'email' => $email,
                            'user_id' => $user->getId(),
                            'username' => $user->getUsername(),
                        ];
                        setUserSession($data);
                        redirectTo("/dashboard");
                        exit;
                    } else {
                        $errors[] = 'User or email is not correct, please try again';
                    }
                } else { 
                    $errors[] = 'User not found, please try again';
                }
            }
        }
        echo $this->twig->render("auth/login.twig", compact('errors'));
    }
    
    /**
     * logout function
     *
     * @return void
     */
    public function logout()
    {
        if(isset($_POST['submit']))
        {
            session_unset();
            session_destroy();
            redirectTo("/login");
        }
    }

    /**
     * register function
     *
     * @return void
     */
    public function register()
    {
        $post = [];
        $data = [];
        $errors = [];
        if(isset($_POST['submit']))
        {
            $post = $_POST;

            $email = NULL;
            $username = NULL;
            $password = NULL;
            
            if(empty($_POST['password']) || (strlen($_POST['password'])<5))
            {
                $errors[] = 'The password field is required and needs 5 chars min length';
            }
            
            if(empty($_POST['password_confirm']) || (strlen($_POST['password_confirm']) < 5))
            {
                $errors[] = 'The password confirmation is required and needs 5 chars min length';
            }
            
            if($_POST['password'] !== $_POST['password_confirm'])
            {
                $errors[] = 'The passwords needs to be equals';
            }
            
            $email = !empty($_POST['email']) ? $_POST['email'] : '';
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $errors[] = 'The email field has not a valid value';
            }
            
            if(strlen($_POST['username'])<5)
            {
                $errors[] = 'The username field needs a min length of 5 characters';
            }
            
            if(empty($errors))
            {
                $username = filter_input(INPUT_POST, 'username');
                $password = filter_input(INPUT_POST, 'password');
                $user = new User;
                $user->setEmail($email);
                $user->setUsername($username);
                $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
                $this->doctrine->em->persist($user);
                $this->doctrine->em->flush();
                
                $post = [];

                $data[] = [
                    'email' => $email,
                    'username' => $username,
                    'user_id' => $user->getId(),
                ];
                setUserSession($data);
                redirectTo("/dashboard");
                exit;
            }
        }
        echo $this->twig->render("auth/register.twig",  compact('errors', 'post'));
    }
}