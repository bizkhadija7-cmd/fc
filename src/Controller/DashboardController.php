<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\CoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(UserRepository $userRepo, CoursRepository $coursRepo): Response
    {
        $nbUsers = count($userRepo->findAll());
        $nbCours = count($coursRepo->findAll());

        return $this->render('dashboard/index.html.twig', [
            'users'=>$nbUsers,
            'cours'=>$nbCours
        ]);
    }
}