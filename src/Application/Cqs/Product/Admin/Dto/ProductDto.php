<?php

namespace App\Application\Cqs\Product\Admin\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class ProductDto
{
    /**
     * @var ProductContentDto
     * @Assert\NotBlank()
     */
    public $content;

    /**
     * @var float
     * @Assert\NotBlank()
     */
    public $price;

    /**
     * @var string[]
     * @Assert\All(
     *     @Assert\NotBlank(),
     *     @Assert\Uuid()
     * )
     */
    public $categories = [];
}