<?php

namespace App\Controller;

use App\Form\ContactType;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $form =$this->createForm(ContactType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $contact = $form->getData();
            //ici nous envoyons le mail
           $message=(new \Swift_Message('Nouveau contact'))
               //On attribue l'expéditeur

               ->setFrom($contact['Email'])
               //On attribue le destinataire
            ->setTo('hajer.2017hassine@gmail.com')
               //On cree le message avec la vue twig
            ->setBody(
                $this->renderView(
                    'emails/contact.html.twig', compact('contact')
                ),
                   'text/html'
               )
               ;
           //On envoie le message
            $mailer->send($message);
            $this->addFlash('message', 'Le message a bien été envoyé');
            return $this->redirectToRoute('matchs_index');
    }

        return $this->render('contact/index.html.twig', [
            'ContactForm' => $form->createView()
        ]);
    }
}
