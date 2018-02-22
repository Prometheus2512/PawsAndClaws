<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()

    {           $em=$this->getDoctrine()->getManager();
        /*$likes=$em->getRepository('MainBundle:Appreciation')->findBy(['type'=>1]);
        $highestlikes=0;
        $cart = array();
        $articles= $em->getRepository('MainBundle:Appreciation')->findAll();
        foreach ($articles as $article )
        {

            $likes=$em->getRepository('MainBundle:Appreciation')->findBy(['type'=>1,'eventappreciated'=>$article]);
         $calculate=count($likes);
         if ($calculate>$highestlikes){$highestlikes=$calculate;};

        }*/
/*        $mostliked=$em->getRepository('MainBundle:Article')-> getmostlikedArticle();*/
        $event= $em->getRepository('MainBundle:Event')->getmostviewedEvent();

        return $this->render('MainBundle:Default:index.html.twig', array(
            'event' => $event,
     /*       'articles'=> $mostliked*/
        ));
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
    public function calendarAction()
    {
        return $this->render('MainBundle:Default:calendar.html.twig');
    }
}
