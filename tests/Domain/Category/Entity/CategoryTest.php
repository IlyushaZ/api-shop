<?php

namespace App\Tests\Domain\Category\Entity;


use App\Domain\Category\Entity\Category;
use App\Domain\Category\Entity\CategoryContent;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    /** @var Category $category */
    private $category;

    protected function setUp(): void
    {
        $this->category = new Category(
            new CategoryContent('title', 'description'),
            new Category(
                new CategoryContent('title1', 'description1')
            )
        );
    }

    public function testGetContent()
    {
        $this->assertInstanceOf(CategoryContent::class, $this->category->getContent());
        $this->assertEquals('title', $this->category->getContent()->getTitle());
        $this->assertEquals('description', $this->category->getContent()->getDescription());
    }

    public function testGetParent()
    {
        $this->assertInstanceOf(Category::class, $this->category->getParent());
        $this->assertEquals('title1', $this->category->getParent()->getContent()->getTitle());
        $this->assertEquals('description1', $this->category->getParent()->getContent()->getDescription());
    }

    public function testGetChildren()
    {
        $this->assertInstanceOf(Collection::class, $this->category->getChildren());
        $this->assertEmpty($this->category->getChildren());
    }
}