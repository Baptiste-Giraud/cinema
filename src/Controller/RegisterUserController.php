<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegisterUserController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/users/register", name="register_user", methods={"POST"})
     */
    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $user = new User();
        $user->setUsername($data['username']);
        $user->setPassword(password_hash($data['password'], PASSWORD_DEFAULT));

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return new JsonResponse(['status' => 'User created'], JsonResponse::HTTP_CREATED);
    }
}
