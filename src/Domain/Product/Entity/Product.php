<?php

namespace App\Domain\Product\Entity;


use App\Domain\Category\Entity\Category;
use App\Domain\Common\Money;
use App\Domain\Common\Traits\CreatedAt;
use App\Domain\Common\Traits\Entity;
use App\Domain\Common\Traits\IsAvailable;
use App\Domain\Common\Traits\UpdatedAt;
use App\Domain\User\Entity\Admin;
use Assert\Assertion;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Product
{
    use Entity, CreatedAt, UpdatedAt, IsAvailable;

    private $content;
    private $categories;
    private $price;

    private $addedBy;

    private $units;

    public function __construct(ProductContent $content, Money $price, Admin $addedBy)
    {
        $this->identify();

        $this->content = $content;
        $this->categories = new ArrayCollection();
        $this->price = $price;
        $this->addedBy = $addedBy;

        $this->units = new ArrayCollection();

        $this->onCreated();
    }

    public function getContent(): ProductContent
    {
        return $this->content;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function getPrice(): Money
    {
        return $this->price;
    }

    public function getUnits(): Collection
    {
        return $this->units;
    }

    public function hasCategory(Category $category): bool
    {
        return $this->categories->contains($category);
    }

    public function addCategory(Category $category): self
    {
        Assertion::false(
            $this->hasCategory($category),
            'Given category already exists for this product!'
        );

        $this->categories->add($category);
        return $this;
    }

    public function removeCategory(Category $category): self
    {
        Assertion::true(
            $this->hasCategory($category),
            'Given category does not exist for this product!'
        );

        $this->categories->removeElement($category);
        return $this;
    }
}