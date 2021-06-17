<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/{username}', name: 'profile')]
    public function profile(Request $request): Response
    {
        $username = $request->get(key: 'username');
        return $this->render('home/profile.html.twig', [
            'username' => $username
        ]);
    }
}
