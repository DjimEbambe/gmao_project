<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;


class RegisterController extends AbstractController
{
    private $entityManager;
    private $security;

    public function __construct(EntityManagerInterface $entityManager, Security $security){
        $this->entityManager=$entityManager;
        $this->security = $security;
    }

    #[Route('/register', name: 'register')]
    public function index(Request $request, UserPasswordEncoderInterface $encoder, UserAuthenticatorInterface $authenticator, LoginFormAuthenticator $formAuthenticator): Response
    {
        $user = new User();
        $notification = null;
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $search_phone = $this->entityManager->getRepository(User::class)->findOneByPhone($user->getPhone());
            if ($search_phone) {
                $notification = 'Ce numéro  existe déjà !';
            }
            else{
                $password = $encoder->encodePassword($user, $user->getPassword());
                $user->setPassword($password);
                $this->entityManager->persist($user);
                $this->entityManager->flush();

                // substitute the previous line (redirect response) with this one.
                return $authenticator->authenticateUser(
                    $user,
                    $formAuthenticator,
                    $request);
                //return $guard->authenticateUserAndHandleSuccess($user,$request,$login,'main');
            }
        }
        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
            'notification' => $notification
        ]);
    }
}
