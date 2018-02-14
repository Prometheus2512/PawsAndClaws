<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Reservation;
use MainBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function reservationAction( $uid,  $eid)
    {
        $user=$this->getUser();
        $actualuid=$user->getid();

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('MainBundle:User')->findOneBy(['id' => $uid]);
        $event = $em->getRepository('MainBundle:Event')->findOneBy(['id' => $eid]);
        if (($actualuid==$uid)&&($actualuid!=$event->gethostid()->getid()))
        {
            $reservation = new Reservation();



            $em->persist($reservation);
            $reservation->setParticipantid($user);
            $reservation->setEventid($event);
            $em->flush();



            return $this->redirectToRoute('event_show', array('id' => $event->getId()));

        }
        return $this->render('event/errorreservation.html.twig');
    }

}
