<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MainBundle:Default:index.html.twig');
    }
    public function servicesAction()
    {
        return $this->render('MainBundle:Default:services.html.twig');
    }
    public function petsAction()
    {
        return $this->render('MainBundle:Default:pets.html.twig');
    }
    public function contactAction()
    {
        return $this->render('MainBundle:Default:contact.html.twig');
    }
    public function leisureAction()
    {
        return $this->render('MainBundle:Default:leisure.html.twig');
    }
    public function productsAction()
    {
        return $this->render('MainBundle:Default:products.html.twig');
    }
    public function singlepetAction()
    {
        return $this->render('MainBundle:Default:singlepet.html.twig');
    }
}
