<?php

namespace App\Domain\Common;


class PaginatedContent
{
    public $content;
    public $perPage;
    public $totalCount;

    public function __construct(array $content, int $perPage, int $totalCount)
    {
        $this->content = $content;
        $this->perPage = $perPage;
        $this->totalCount = $totalCount;
    }
}