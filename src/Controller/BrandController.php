<?php


namespace App\Controller;

use App\Entity\Brand;
use App\Repository\BrandRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/api/brands")
 */
class BrandController extends AbstractApiController
{
    /**
     * @Route(methods={"GET"}, name="api_list_brand")
     *
     * @param BrandRepository $repository
     * @return JsonResponse
     */
    public function listBrands(BrandRepository $repository)
    {
        $brands = $repository->findAll();

        return $this->createApiResponse($brands);
    }

    /**
     * @Route("/{brand}", methods={"GET"}, requirements={"brand": "\d+"}, name="api_get_brand")
     *
     * @param Brand $brand
     * @return JsonResponse
     */
    public function getBrand(Brand $brand)
    {
        return $this->createApiResponse($brand);
    }
}