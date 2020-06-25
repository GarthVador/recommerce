<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

    /**
     * @Route(methods={"POST"}, name="api_create_order")
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function createOrder(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(OrderType::class);
        $order = $this->processForm($request, $form);

        $em->persist($order);
        $em->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}