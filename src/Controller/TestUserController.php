<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TestUserController extends AbstractController
{
    #[Route('/test/user', name: 'app_test_user')]
    public function index(ValidatorInterface $validator, EntityManagerInterface $entityManager): Response
    {

        $user = new User();
        $user->setCreatedAt(new \DateTimeImmutable('now'));
        $user->setPrenom("");
        $user->setNom("");
        $user->setEmail("");
        $user->setTelephone("");
        $user->setAge(1);
        $errors = $validator->validate($user);

        if(count($errors)>0){
            dd($errors);
        }
        $entityManager->persist($user);
        $entityManager->flush();


        dd($user);
        return $this->render('test_user/index.html.twig', [
            'controller_name' => 'TestUserController',
        ]);
    }
}
