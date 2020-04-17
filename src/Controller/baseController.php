<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class baseController extends AbstractController
{
    /**
     * @Route("/inicio", name="inicio")
     */
    public function inicio(){
        return $this->render('inicio.html.twig');
    }

    /**
     * @Route("/servicios")
     */
    public function servicios(){
        return $this->render('servicios.html.twig');
    }

    /**
     * @Route("/registro")
     */
    public function registro(){
        return $this->render('registro.html.twig');
    }


    /**
     * @Route("/inicioSesion", name="inicioSesion")
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
        $login = $request->request->get('user');
        if ($login != "") {
            $session->set('username', $login);
            $mensaje = "Hola ".$login." estas conectado.";
        
        } else {
            $mensaje = "Introduce los credenciales.";

        }
        return $this->render('sesionIniciada.html.twig', [
            'sesion' => $mensaje,
            'login' => $login
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(SessionInterface $session)
    {
        $session->invalidate();
        return $this->redirectToRoute('inicioSesion');
    }
}
