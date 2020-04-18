<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;


class baseController extends AbstractController
{
    /**
     * @Route("/inicio", name="inicio")
     */
    public function inicio(SessionInterface $session, Request $request){
        $login = $request->request->get('user');
        return $this->render('inicio.html.twig', [
            'login' => $login
       ]);
    }

    /**
     * @Route("/servicios")
     */
    public function servicios(SessionInterface $session, Request $request){
        $login = $request->request->get('user');
        return $this->render('servicios.html.twig', [
            'login' => $login]);
    }

    /**
     * @Route("/registro")
     */
    public function registro(SessionInterface $session){
        return $this->render('registro.html.twig');
    }


    /**
     * @Route("/inicioSesion", name="login")
     */
    public function login(SessionInterface $session){
       $login = $session->get('username');
       return $this->render('inicioSesion.html.twig', [
            'login' => $login
       ]);
    }

    /**
     * @Route("/loggedin", name="logging")
     */
    public function logging(Request $request, SessionInterface $session)
    {
        $session = new Session();
        $session->start();
        $session->set('username', $request->request->get('user'));
        return $this->redirectToRoute('cuenta');
    }

    /**
     * @Route("/pagCuenta", name="cuenta")
     */
    public function cuenta(Request $request, SessionInterface $session)
    {
        $login = $request->request->get('user');
        return $this->render('sesionIniciada.html.twig', [
            'login' => $login
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(SessionInterface $session)
    {
        $session->remove('username');
        return $this->redirectToRoute('login');
    }
}
