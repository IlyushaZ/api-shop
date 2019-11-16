<?php

namespace App\Application\Cqs\Product\Common\Output;


use App\Domain\Product\Entity\ProductContent;

class ProductOutput
{
    /** @var string */
    public $id;

    /** @var ProductContent */
    public $content;

    /** @var float */
    public $price;

    /** @var boolean */
    public $isAvailable;

    /** @var string[] */
    public $categories;
}