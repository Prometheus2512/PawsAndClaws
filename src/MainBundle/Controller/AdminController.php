<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('MainBundle:admin:index.html.twig');
    }
    public function tablesAction()
    {
        return $this->render('MainBundle:admin:tables.html.twig');
    }
}
