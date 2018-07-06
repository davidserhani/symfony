<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends Controller
{
    /**
     * @Route("/registration", name="registration")
     * @param Request $request
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registration( Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder )
    {
        $user = new User();

        $form =$this->createForm( RegistrationType::class, $user );
        $form->handleRequest( $request );

        if ( $form->isSubmitted()  AND $form->isValid() ){
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();
            $this->addFlash(
                'success',
                'Welcome !'
            );
            return $this->redirectToRoute('event_list');
        }
        return $this->render('security/registration.html.twig', [
            'formRegistration' => $form->createView()
        ]);
    }
}
