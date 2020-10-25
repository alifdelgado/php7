<?php

namespace App\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repositories\UserRepository")
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var int
     */
    protected int $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected string $username;
    
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected string $password;
    
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected string $email;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     * @var DateTime
     */
    protected DateTime $created;

    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="user", cascade={"persist", "remove"})
     * @var Collection
     */
    protected Collection $posts;

    public function __construct()
    {
        $this->created = new DateTime();
        $this->posts = new ArrayCollection();
    }

    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of username
     *
     * @return  string
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @param  string  $username
     *
     */ 
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    /**
     * Get the value of password
     *
     * @return  string
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param  string  $password
     *
     */ 
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * Get the value of email
     *
     * @return  string
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string  $email
     *
     */ 
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * Get the value of created
     *
     * @return  Datetime
     */ 
    public function getCreated(): DateTime
    {
        return $this->created;
    }

    /**
     * Get the value of posts
     *
     * @return  Collection
     */ 
    public function getPosts(): Collection
    {
        return $this->posts;
    }
}