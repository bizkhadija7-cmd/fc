<?php

namespace App\Controller;

use App\Repository\CoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CourseController extends AbstractController
{
    #[Route('/courses', name: 'app_courses')]
    public function index(CoursRepository $repo): Response
    {
        return $this->render('course/index.html.twig', [
            'courses' => $repo->findAll()
        ]);
    }
}