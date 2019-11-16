<?php

namespace App\Domain\Category\Entity;


use App\Domain\Common\Traits\CreatedAt;
use App\Domain\Common\Traits\Entity;
use App\Domain\Common\Traits\IsRemoved;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Category
{
    use Entity, CreatedAt, IsRemoved;

    private $content;
    private $parent;
    private $children;

    public function __construct(CategoryContent $content, Category $parent = null)
    {
        $this->identify();

        $this->content = $content;
        $this->parent = $parent;
        $this->children = new ArrayCollection();

        $this->onCreated();
    }

    public function getContent(): CategoryContent
    {
        return $this->content;
    }

    public function getParent(): ?Category
    {
        return $this->parent;
    }

    public function getChildren(): Collection
    {
        return $this->children;
    }
}