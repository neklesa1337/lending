<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index()
    {
        return $this->render('main/index.html.twig');
    }

    /**
     * @Route("/thankyou", name="thankyou")
     */
    public function thankYou()
    {
        return $this->render('main/thankyou.html.twig');
    }

    /**
     * @Route("/askcoll", name="askcoll", methods={"POST"})
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function sendColl(
        Request $request,
        \Swift_Mailer $mailer
    )
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('worktowork1331@gmail.com')
            ->setTo('worktowork1331@gmail.com')
            ->setBody(
                $this->renderView(
                    'emails/coll.html.twig',
                    [
                        'formData' => json_decode($request->getContent())
                    ]
                ),
                'text/html'
            )
        ;

        $mailer->send($message);

        return $this->json(['ok']);
    }
}
