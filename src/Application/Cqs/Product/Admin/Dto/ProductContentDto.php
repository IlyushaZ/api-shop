<?php

namespace App\Application\Cqs\Product\Admin\Dto;


use Symfony\Component\Validator\Constraints as Assert;

class ProductContentDto
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $title;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $description;
}