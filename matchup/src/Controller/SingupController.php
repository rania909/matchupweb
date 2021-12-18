<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SignupType;
use App\Security\EmailVerifier;
use App\Form\UserType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

/**
 * @Route("/signup")
 */
class SingupController extends AbstractController
{
    private $emailVerifier;


    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder,EmailVerifier $emailVerifier )
     {
        $this->passwordEncoder = $passwordEncoder;
         $this->emailVerifier = $emailVerifier;
     }
    /**
     * @Route("/", name="signup", methods={"GET","POST"})
     *
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(SignupType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                     $user->setPassword($this->passwordEncoder->encodePassword(
                            $user,
                             'the_new_password'
                        ));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
           $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
              (new TemplatedEmail())
                    ->from(new Address('hamza.lassoued@gmail.com', 'match-up'))
                   ->to($user->getEmail())
                  ->subject('bienvenue')
                  ->htmlTemplate('signup/confirmation_email.html.twig')
           );
            return $this->redirectToRoute('app_login');
        }

        return $this->render('signup/signup.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/verify/email", name="app_verify_email")
     */
    public function verifyUserEmail(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_login');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('app_login');
    }
}