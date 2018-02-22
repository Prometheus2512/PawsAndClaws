<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('MainBundle:admin:index.html.twig');
    }

    public function usertableAction() {
        //access user manager services

        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        return $this->render('MainBundle:admin:usertable.html.twig', array('users' =>   $users));
    }
    public function eventstableAction() {
        //access user manager services

        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('MainBundle:Event')->findBy(['Validated' => 0]);
        $unvalidatedevents=count($events);
        $events = $em->getRepository('MainBundle:Event')->findBy(['Validated' => 1]);
        $validatedevents=count($events);

        $nviews = 0;
        foreach($events as $event){
            $nviews += $event->getViews();
        }

        $comments=$em->getRepository('MainBundle:Commentary')->findAll();
        $ncomments=count($comments);

        $events = $em->getRepository('MainBundle:Event')->findAll(array('beginningDate' => 'DESC'));

        return $this->render('MainBundle:admin:eventstable.html.twig', array(
            'events' => $events,
            'nviews' =>$nviews,
            'vale'=>$validatedevents,
            'unvale'=>$unvalidatedevents,
            'ncom'=>$ncomments
        ));}
    public function articlestableAction() {
        //access user manager services

        $em = $this->getDoctrine()->getManager();


        $articles=$em->getRepository('MainBundle:Article')->findAll(array('creationDate' => 'DESC'));
        $narticles=count($articles);
        $narticles=count($articles);
        $likes=$em->getRepository('MainBundle:Appreciation')->findBy(['type'=>1]);
        $dislikes=$em->getRepository('MainBundle:Appreciation')->findBy(['type'=>2]);
        $nlikes=count($likes);
        $ndislikes=count($dislikes);

        return $this->render('MainBundle:admin:articlestable.html.twig', array(
            'articles' => $articles,
            'nlikes' =>$nlikes,
            'ndislikes'=>$ndislikes,
            'narticles'=>$narticles
        ));}

    public function eventsdeleteAction($id) {
        //access user manager services

        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository('MainBundle:Event')->find($id);
        $em->remove($event);
        $em->flush()
        ;
        $events = $em->getRepository('MainBundle:Event')->findAll(array('beginningDate' => 'DESC'));

        return $this->render('MainBundle:admin:eventstable.html.twig', array(
            'events' => $events,
        ));
    }

    public function validateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('MainBundle:Event')->find($id);

        if ($event) {
            $event->setValidated('1');
            $em->flush();
        }




        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('MainBundle:Event')->findAll(array('beginningDate' => 'DESC'));

        return $this->redirectToRoute('admin-events-table');
    }


}
