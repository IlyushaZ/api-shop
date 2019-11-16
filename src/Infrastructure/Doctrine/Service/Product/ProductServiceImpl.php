<?php

namespace App\Infrastructure\Doctrine\Service\Product;


use App\Application\Cqs\Product\Admin\Dto\ProductContentDto;
use App\Application\Cqs\Product\Admin\Dto\ProductDto;
use App\Domain\Category\Entity\Category;
use App\Domain\Category\Repository\CategoryRepository;
use App\Domain\Common\Money;
use App\Domain\Common\Transaction;
use App\Domain\Product\Entity\Product;
use App\Domain\Product\Entity\ProductContent;
use App\Domain\Product\Repository\ProductRepository;
use App\Domain\Product\Service\ProductService;
use App\Domain\User\Entity\Admin;

class ProductServiceImpl implements ProductService
{
    private $productRepository;
    private $categoryRepository;

    private $transaction;

    public function __construct(ProductRepository $productRepository,
                                CategoryRepository $categoryRepository,
                                Transaction $transaction)
    {
        $this->productRepository = $productRepository;
        $this->transaction = $transaction;
        $this->categoryRepository = $categoryRepository;
    }

    public function create(Admin $admin, ProductDto $dto): Product
    {
        $product = new Product(
            $this->fillProductContent($dto->content),
            $this->floatToMoney($dto->price),
            $admin
        );

        foreach ($dto->categories as $category) {
            $product->addCategory($this->categoryRepository->getById($category));
        }

        $this->transaction->makeTransaction(function () use ($product) {
            $this->productRepository->save($product);
        });

        return $product;
    }

    public function edit(string $productId, ProductDto $dto): Product
    {
        $product = $this->productRepository->getById($productId);

        $product->changeContent($this->fillProductContent($dto->content));
        $product->changePrice($this->floatToMoney($dto->price));
        $product = $this->editCategories($product, $dto->categories);

        $this->transaction->makeTransaction(function () use ($product) {
            $this->productRepository->save($product);
        });

        return $product;
    }

    public function archive(string $productId): void
    {
        $product = $this->productRepository->getById($productId);

        $product->archive();

        $this->transaction->makeTransaction(function () use ($product) {
            $this->productRepository->save($product);
        });
    }

    private function fillProductContent(ProductContentDto $dto): ProductContent
    {
        return new ProductContent(
            $dto->title,
            $dto->description
        );
    }

    private function floatToMoney(float $price): Money
    {
        return new Money($price);
    }

    private function editCategories(Product $product, array $categories): Product
    {
        $categoriesToRemove = array_diff($this->getCategoriesIds($product), $categories);

        foreach ($categoriesToRemove as $category) {
            $product->removeCategory($this->categoryRepository->getById($category));
        }

        $categoriesToAdd = array_diff($categories, $this->getCategoriesIds($product));

        foreach ($categoriesToAdd as $category) {
            $product->addCategory($this->categoryRepository->getById($category));
        }

        return $product;
    }

    private function getCategoriesIds(Product $product): array
    {
        $categoriesIds = [];

        foreach ($product->getCategories() as $category) {
            /** @var Category $category */
            $categoriesIds[] = $category->getId();
        }

        return $categoriesIds;
    }
}