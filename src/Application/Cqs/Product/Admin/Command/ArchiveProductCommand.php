<?php

namespace App\Application\Cqs\Product\Admin\Command;


class ArchiveProductCommand extends ProductCommand
{
    public function execute(string $productId): array
    {
        $this->service->archive($productId);

        return [];
    }
}