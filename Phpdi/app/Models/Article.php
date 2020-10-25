<?php

namespace App\Models;

use App\Interfaces\ArticleInterface;

class Article
{
    /**
     * @var int $id
     */
    protected int $id;
    
    /**
     * @var string $title
     */
    protected string $title;

    /**
     * @var string $content
     */
    protected string $content;

    public function __construct(int $id, string $title, string $content)
    {
        
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }
}