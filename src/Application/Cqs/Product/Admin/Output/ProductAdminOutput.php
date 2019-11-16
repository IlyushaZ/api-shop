<?php

namespace App\Application\Cqs\Product\Admin\Output;


use App\Application\Cqs\Product\Common\Output\ProductOutput;
use App\Application\Cqs\User\Common\Output\UserOutput;
use App\Domain\Common\Traits\Paginator;
use App\Domain\Product\Entity\Product;

class ProductAdminOutput extends ProductOutput
{
    use Paginator;

    /** @var \DateTimeImmutable */
    public $createdAt;

    /** @var \DateTimeImmutable */
    public $updatedAt;

    /** @var UserOutput */
    public $addedBy;

    //TODO: добавить информацию о количестве товара на складе.
    public static function fromEntity(Product $product): self
    {
        $result = new static();

        $result->id = $product->getId()->toString();
        $result->content = $product->getContent();
        $result->price = $product->getPrice();
        $result->isAvailable = $product->isAvailable();
        $result->categories = $product->getCategories()->toArray();
        $result->createdAt = $product->getCreatedAt();
        $result->updatedAt = $product->getUpdatedAt();
        $result->addedBy = UserOutput::fromEntity($product->getAddedBy());

        return $result;
    }
}