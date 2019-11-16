<?php

namespace App\Application\Http\Client;

use App\Application\Cqs\Product\Client\Output\ProductClientOutput;
use App\Application\Cqs\Product\Client\Query\GetProductByIdQuery;
use App\Application\Cqs\Product\Common\Criteria\ProductCriteria;
use App\Application\Cqs\Product\Common\Query\GetAllProductsQuery;
use App\Domain\Common\PaginatedContent;
use App\Domain\User\Entity\Client;
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
     *     @SWG\Schema(type="object", ref=@Model(type=App\Application\Cqs\Product\Client\Output\ProductClientOutput::class))
     * )
     *
     * @SWG\Tag(name="client")
     *
     * @Route("", methods={"GET"})
     */
    public function getAllWithFilters(GetAllProductsQuery $query,
                                      ProductCriteria $criteria,
                                      int $limit = 10,
                                      int $offset = 0): PaginatedContent
    {
        return $query->execute($criteria, $limit, $offset);
    }

    /**
     * Получение информации о продукте по id.
     *
     * @SWG\Response(
     *     response=200,
     *     description="Возвращает продукт по его id",
     *     @SWG\Schema(type="object", ref=@Model(type=App\Application\Cqs\Product\Client\Output\ProductClientOutput::class))
     * )
     *
     * @SWG\Tag(name="client")
     *
     * @Route("/{productId}", methods={"GET"})
     */
    public function view(Client $client, GetProductByIdQuery $query, string $productId): ProductClientOutput
    {
        return $query->execute($productId);
    }
}