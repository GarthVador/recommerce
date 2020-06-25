<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/api/orders")
 */
class OrderController extends AbstractApiController
{
    /**
     * @Route(methods={"GET"}, name="api_list_order")
     *
     * @param OrderRepository $repository
     * @return JsonResponse
     */
    public function listorders(OrderRepository $repository)
    {
        $orders = $repository->findAll();

        return $this->createApiResponse($orders);
    }

    /**
     * @Route("/{order}", methods={"GET"}, requirements={"order": "\d+"}, name="api_get_order")
     *
     * @param Order $order
     * @return JsonResponse
     */
    public function getorder(Order $order)
    {
        return $this->createApiResponse($order);
    }
}