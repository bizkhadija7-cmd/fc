<?php

namespace App\Controller;

use App\Repository\AbonnementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AbonnementController extends AbstractController
{
    #[Route('/subscriptions', name: 'app_subscriptions')]
    public function index(AbonnementRepository $repo): Response
    {
        return $this->render('abonnement/index.html.twig', [
            'abonnements' => $repo->findAll()
        ]);
    }
}