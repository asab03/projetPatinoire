<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class NavigationController extends AbstractController
{
    /**
     * @Route("/", name="connection")
     */
    public function connection()
    {
        return $this->render('navigation/connection.html.twig');
    }

    /**
    * @Route("/home", name="home")
    * 
    */
        public function membre(SessionInterface $session)
        {
            $user = $this->getUser();
            if($user && in_array('IS_AUTHENTICATED_FULLY', $user->getRoles())){
            return $this->render('navigation/home.html.twig');}

        $session->set("message", "Vous devez etre connecté pour acceder, vous avez été redirigé sur cette page");
        return $this->redirectToRoute('connection');
        

        }


    /**
    * @Route("/admin", name="admin")
    * 
    */
        public function admin(SessionInterface $session)
        {
            $user = $this->getUser();
            if($user && in_array('ROLE_ADMIN', $user->getRoles())){
                return $this->render('user/index.html.twig');
        }

        $session->set("message", "Vous n'avez pas le droit d'acceder à la page admin vous avez été redirigé sur cette page");
        return $this->redirectToRoute('home');
        }   
}
