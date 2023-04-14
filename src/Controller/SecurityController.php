<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityController extends AbstractController
{
    #[Route('/inscription', name:"SecurityController")]
    public function registration (Request $request, EntityManagerInterface $manager,UserPasswordHasherInterface $encoder){
        $user = new User();
        $form=$this->createForm(RegistrationType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $hash= $encoder->hashPassword( $user ,$user->getPassword());
            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('SecurityLogin');
        }
        return $this->render('security/registration.html.twig',[
            'form' => $form->createView()
        ]);

    }
    #[Route('/login',name:'SecurityLogin')]
    public function login(){
        return $this->render('security/login.html.twig');
    }
    #[Route('/logout',name:'SecurityLogout')]
    public function logout(){}
}
