<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthController extends AbstractController
{
    /**
     * @Route("/api/login", name="login", methods={"POST"})
     */
    public function login(Request $request, JWTTokenManagerInterface $JWTManager, UserInterface $user)
    {
        return new JsonResponse(['token' => $JWTManager->create($user)]);
    }
}
