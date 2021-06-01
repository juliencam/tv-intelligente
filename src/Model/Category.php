<?php
namespace App\Model;

class Category {
    private $id;
    private $name;
    private $slug;
    private $post_id;
    private $post;
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    public function getPost_id()
    {
        return $this->post_id;
    }

    public function setPost_id($post_id)
    {
        $this->post_id = $post_id;

        return $this;
    }

    public function setPost(Post $post)
    {
        $this->post = $post;
    }
} 