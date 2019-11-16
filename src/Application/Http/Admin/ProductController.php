<?php

namespace App\Application\Http\Admin;

use App\Application\Cqs\Product\Admin\Command\ArchiveProductCommand;
use App\Application\Cqs\Product\Admin\Command\CreateProductCommand;
use App\Application\Cqs\Product\Admin\Command\EditProductCommand;
use App\Application\Cqs\Product\Admin\Dto\ProductDto;
use App\Application\Cqs\Product\Admin\Output\ProductAdminOutput;
use App\Application\Cqs\Product\Admin\Query\GetAllProductsQuery;
use App\Application\Cqs\Product\Admin\Query\GetProductByIdQuery;
use App\Application\Cqs\Product\Common\Criteria\ProductCriteria;
use App\Domain\Common\PaginatedContent;
use App\Domain\User\Entity\Admin;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/products")
 */
class ProductController
{
    /**
     * Получение списка всех продуктов с фильтрами и сортировкой.
     *
     * @SWG\Parameter(
     *     name="filters[category]",
     *     in="query",
     *     type="string",
     *     required=false,
     *     description="Фильтр по категории продукта."
     * ),
     *
     * @SWG\Parameter(
     *     name="filters[priceFrom]",
     *     in="query",
     *     type="number",
     *     required=false,
     *     description="Фильтр по минимальной цене"
     * ),
     *
     * @SWG\Parameter(
     *     name="filters[priceTo]",
     *     in="query",
     *     type="number",
     *     required=false,
     *     description="Фильтр по максимальной цене"
     * ),
     *
     * @SWG\Parameter(
     *     name="sort",
     *     in="query",
     *     type="string",
     *     required=false,
     *     description="Поле, по которому необходимо сортировать"
     * ),
     *
     * @SWG\Parameter(
     *     name="order",
     *     in="query",
     *     type="string",
     *     required=false,
     *     description="Порядок вывода"
     * )
     *
     * @SWG\Parameter(
     *     name="limit",
     *     in="query",
     *     type="integer",
     *     required=false,
     *     description="Максимальное количество выводимых результатов"
     * ),
     *
     * @SWG\Parameter(
     *     name="offset",
     *     in="query",
     *     type="integer",
     *     required=false,
     *     description="Смещение"
     *
     * )
     *
     * @SWG\Response(
     *     response=200,
     *     description="Возвращает список продуктов с сортировкой и фильтрами",
     *     @SWG\Schema(type="object", ref=@Model(type=App\Application\Cqs\Product\Admin\Output\ProductAdminOutput::class))
     * )
     *
     * @SWG\Tag(name="admin")
     *
     * @Route("", methods={"GET"})
     */
    public function getAllWithFilters(Admin $admin,
                                      GetAllProductsQuery $query,
                                      ProductCriteria $criteria = null,
                                      int $limit = 10,
                                      int $offset = 0): PaginatedContent
    {
        return $query->execute($criteria, $limit, $offset);
    }

    /**
     * Создание нового продукта.
     *
     * @SWG\Parameter(
     *     name="Данные о новом продукте",
     *     type="application/json",
     *     in="body",
     *     required=true,
     *     @SWG\Schema(type="object", ref=@Model(type=App\Application\Cqs\Product\Admin\Dto\ProductDto::class))
     * )
     *
     * @SWG\Response(
     *     response=201,
     *     description="Возвращает созданный продукт",
     *     @SWG\Schema(type="object", ref=@Model(type=App\Application\Cqs\Product\Admin\Output\ProductAdminOutput::class))
     * )
     *
     * @SWG\Tag(name="admin")
     *
     * @Route("", methods={"POST"})
     */
    public function create(Admin $admin, CreateProductCommand $command, ProductDto $dto): ProductAdminOutput
    {
        return $command->execute($admin, $dto);
    }

    /**
     * Получение информации о продукте по id.
     *
     * @SWG\Response(
     *     response=200,
     *     description="Возвращает продукт по его id",
     *     @SWG\Schema(type="object", ref=@Model(type=App\Application\Cqs\Product\Admin\Output\ProductAdminOutput::class))
     * )
     *
     * @SWG\Tag(name="admin")
     *
     * @Route("/{productId}", methods={"GET"})
     */
    public function view(Admin $admin, GetProductByIdQuery $query, string $productId): ProductAdminOutput
    {
        return $query->execute($productId);
    }

    /**
     * Редактирование продукта.
     *
     * @SWG\Parameter(
     *     name="Данные о редактируемом продукте",
     *     type="application/json",
     *     in="body",
     *     required=true,
     *     @SWG\Schema(type="object", ref=@Model(type=App\Application\Cqs\Product\Admin\Dto\ProductDto::class))
     * )
     *
     * @SWG\Response(
     *     response=200,
     *     description="Возвращает измененный продукт",
     *     @SWG\Schema(type="object", ref=@Model(type=App\Application\Cqs\Product\Admin\Output\ProductAdminOutput::class))
     * )
     *
     * @SWG\Tag(name="admin")
     *
     * @Route("/{productId}", methods={"PUT"})
     */
    public function edit(Admin $admin, EditProductCommand $command, ProductDto $dto, string $productId): ProductAdminOutput
    {
        return $command->execute($productId, $dto);
    }

    /**
     * Помещение продукта в архив.
     *
     * @SWG\Response(
     *     response=200,
     *     description="Пустой респонс"
     * )
     *
     * @SWG\Tag(name="admin")
     *
     * @Route("/{productId}", methods={"DELETE"})
     */
    public function archive(Admin $admin, ArchiveProductCommand $command, string $productId): array
    {
        return $command->execute($productId);
    }
}