<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
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

    protected function processForm(Request $request, FormInterface $form)
    {
        $body = $this->parseBody($request);

        $form->submit($body);

        if (!$form->isValid()) {
            throw new BadRequestHttpException("Wrong json sent");
        }

        return $form->getData();
    }

    protected function parseBody(Request $request): array
    {
        $content = $request->getContent() ?? '';

        $body = $this->get('serializer')->decode($content, JsonEncoder::FORMAT);

        return $body;
    }
}