<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('MainBundle:admin:index.html.twig');
    }

    public function tablesAction() {
        //access user manager services

        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        return $this->render('MainBundle:admin:tables.html.twig', array('users' =>   $users));
    }
}
