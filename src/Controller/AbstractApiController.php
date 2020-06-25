<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

abstract class AbstractApiController extends AbstractController
{
    private $normalizer;

    public function __construct(NormalizerInterface $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    protected function createApiResponse($object): JsonResponse
    {
        $data = $this->normalizer->normalize($object, JsonEncoder::FORMAT, $this->createContext());

        return new JsonResponse($data);
    }

    protected function createContext()
    {
        return [
            AbstractNormalizer::GROUPS => ['api']
        ];
    }
}