<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/api/products")
 */
class ProductController extends AbstractApiController
{
    /**
     * @Route(methods={"GET"}, name="api_list_product")
     *
     * @param ProductRepository $repository
     * @return JsonResponse
     */
    public function listProducts(ProductRepository $repository)
    {
        $products = $repository->findAll();

        return $this->createApiResponse($products);
    }

    /**
     * @Route("/{product}", methods={"GET"}, requirements={"product": "\d+"}, name="api_get_product")
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function getProduct(Product $product)
    {
        return $this->createApiResponse($product);
    }
}