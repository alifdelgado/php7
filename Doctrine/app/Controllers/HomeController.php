<?php

namespace App\Controllers;

use Exception;
use Twig\Environment;
use App\Entities\Post;
use App\Entities\User;
use App\Services\Doctrine;

class HomeController
{
    /**
     * @var Environment $twig
     */
    private Environment $twig;

    /**
     * @var Doctrine $doctrine
     */
    private Doctrine $doctrine;

    /**
     * Constructor function
     *
     * @param Doctrine $doctrine
     * 
     * @param Environment $twig
     */
    public function __construct(Doctrine $doctrine, Environment $twig)
    {
        $this->twig = $twig;
        $this->doctrine = $doctrine;
    }

    /**
     * index function
     * 
     * go to home view
     * 
     * @return void
     */
    public function index()
    {
        echo $this->twig->render("home.twig");
    }

    /**
     * all function
     * 
     * get all users
     * 
     * @return void
     */
    public function all()
    {
        $users = $this->doctrine->em->getRepository('App\Entities\User')->findAll();
        // var_dump($users);
        foreach($users as $user)
        {
            echo $user->getCreated()->format('Y-m-d');
        }
    }

    /**
     * insert function
     * 
     * create new user
     * 
     * @return void
     */
    public function insert()
    {
        try {
            $user = new User;
            $user->setEmail("user2@email.com");
            $user->setUsername("user2");
            $user->setPassword(password_hash("password", PASSWORD_DEFAULT));
            $this->doctrine->em->persist($user);
            $this->doctrine->em->flush();
            echo "usuario creado correctamente con el id {$user->getId()}";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * findById function
     * 
     * show user
     * 
     * @param integer $id
     * 
     * @return void
     */
    public function findById(int $id)
    {
        $user = $this->doctrine->em->find(User::class, $id);
        var_dump($user);
    }

    /**
     * update function
     *
     * update user
     * 
     * @param integer $id
     * 
     * @return void
     */
    public function update(int $id)
    {
        $user = $this->doctrine->em->find(User::class, $id);
        $user->setUsername("app-user");
        $this->doctrine->em->persist($user);
        $this->doctrine->em->flush();
        echo "usuario con el id {$user->getId()} actualizado correctamente";
    }

    /**
     * remove function
     *
     * remove user
     * 
     * @param integer $id
     * 
     * @return void
     */
    public function remove(int $id)
    {
        $user = $this->doctrine->em->find(User::class, $id);
        if(!$user)
        {
            echo "El usuario con id {$id} no existe";
            exit;
        }
        $this->doctrine->em->remove($user);
        $this->doctrine->em->flush();
        echo "Usuario eliminado correctamente";

    }

    /**
     * findByusername function
     *
     * @param string $username
     * 
     * @return void
     */
    public function findByUsername(string $username)
    {
        $user = $this->doctrine->em->getRepository(User::class)->getUserByUsername($username);
        if (!$user) {
            $user = $this->doctrine->em->find(User::class, $user_id);
            $post = new Post;
            $post->setUser($user);
            $post->setTitle("Nuevo post 1");
            $post->setBody("Contenido del post 1");
            $this->doctrine->em->persist($post);
            $this->doctrine->em->flush();
        
        } else {
            var_dump($user);
        }
    }

    /**
     * insertPost function
     *
     * @param integer $user_id
     * 
     * @return void
     */
    public function insertPost(int $user_id)
    {
        try {
            $user = $this->doctrine->em->find(User::class, $user_id);
            $post = new Post;
            $post->setUser($user);
            $post->setTitle("Nuevo post 2");
            $post->setBody("Contenido del post 2");
            $this->doctrine->em->persist($post);
            $this->doctrine->em->flush();
            echo "Nuevo post vinculado al usuario con id {$user_id}";
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * findUserWithPosts function
     *
     * @param integer $user_id
     * 
     * @return void
     */
    public function findUserWithPosts(int $user_id)
    {
        $user = $this->doctrine->em->find(User::class, $user_id);
        if($user)
        {
            foreach($user->getPosts() as $post)
            {
                echo "{$post->getId()} - {$post->getTitle()} - {$post->getBody()}<br>";
            }
        }
    }
}