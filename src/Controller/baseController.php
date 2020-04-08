<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class EjercicioController extends AbstractController
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
     * @Route("/proyectos/{page2?0}", name="proyectos")
     */
    public function proyectos($page2){
        if($page2 == "1")
        return $this->render("proyectos.html.twig");

        if($page2 == "2")
        return $this->render("proyectos_page2.html.twig");

        if($page2 != "1" && $page2 != "2")
        return $this->render("proyectos.html.twig");
    }

    /**
     * @Route("/proyectos_page2")
     */
    public function proyectos_page2(){
        return $this->render('proyectos_page2.html.twig');
    }

    /**
     * @Route("/nosotros")
     */
    public function nosotros(){
        return $this->render('nosotros.html.twig');
    }

    /**
     * @Route("/contacto")
     */
    public function contacto(){
        return $this->render('contacto.html.twig');
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(SessionInterface $session){
       $login = $session->get('username');
       if ($login != "") {
           $mensaje = "Hola ".$login."estas conectado.";

       } else {
            $mensaje = "Introduce los credenciales.";

       }
       return $this->render('login.html.twig', [
            'sesion' => $mensaje,
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
        return $this->render('login.html.twig', [
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
        return $this->redirectToRoute('inicio');
    }
}
