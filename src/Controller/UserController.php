<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index')]
    public function index(UserRepository $repo): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $repo->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user_new')]
    public function new(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $hasher
    ): Response {

        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // ⚠️ IMPORTANT: ensure password is hashed
            $plainPassword = $user->getPassword();

            $user->setPassword(
                $hasher->hashPassword($user, $plainPassword)
            );

            // optional default role
            $user->setRoles(['ROLE_MEMBER']);

            // save to DB
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('app_user_index');
        }

        return $this->render('user/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}