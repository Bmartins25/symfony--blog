<?php

namespace App\Controller;

use App\Entity\Telefone;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateTelefone
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private RouterInterface $router,
        private SerializerInterface $serializer,
        private ValidatorInterface $validator
    )
    {
    }

    #[Route("/telefone", methods: ["POST"])]
    public function __invoke(Request $request): Response
    {
        $telefone = $this->serializer->deserialize($request->getContent(), Telefone::class, 'json');

        $errors = $this->validator->validate($telefone);

        if (count($errors) > 0) {
            $violations = array_map(function(ConstraintViolationInterface $violation) {
                return [
                    'path' => $violation->getPropertyPath(),
                    'message' => $violation->getMessage()
                ];
            }, iterator_to_array($errors));

            $response = [
                'error' => 'As informações enviadas estão incorretas',
                'violations' => $violations
            ];

            return new JsonResponse($response, Response::HTTP_BAD_REQUEST);
        }

        $this->entityManager->persist($telefone);
        $this->entityManager->flush();

        return new JsonResponse([
            'status' => 'ok'
        ], Response::HTTP_CREATED, [
            'Location' => '/users/'.$telefone->getId()
                
            ]);
        
    
        }
    }