<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/15/18
 * Time: 5:14 AM
 */

namespace MainBundle\Controller;
use MainBundle\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;

class ReservationController extends Controller
{
    public function pdfAction()
    {
        $html = $this->renderView('event\invitation.html.twig', array(

        ));

        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            'file.pdf'
        );
    }
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
}
    public function deleteAction( $uid,  $eid)
    {

        $user=$this->getUser();
        $actualuid=$user->getid();

        $em = $this->getDoctrine()->getManager();

        $reserve = $em->getRepository('MainBundle:Reservation')->findOneBy(['participantid' => $uid,'eventid'=>$eid]);

        if ($actualuid==$uid) {
            $em->remove($reserve);
            $em->flush();
        }


            return $this->redirectToRoute('event_show', array('id' => $eid));



    }



}