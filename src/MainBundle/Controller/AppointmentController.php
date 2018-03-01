<?php

namespace MainBundle\Controller;

use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use MainBundle\Entity\Appointment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Appointment controller.
 *
 */
class AppointmentController extends Controller
{
    /**
     * Lists all appointment entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $appointments = $em->getRepository('MainBundle:Appointment')->findAll();

        return $this->render('appointment/index.html.twig', array(
            'appointments' => $appointments,
        ));
    }

    /**
     * Creates a new appointment entity.
     *
     */
    public function newAction(Request $request)
    {
        $appointment = new Appointment();
        $form = $this->createForm('MainBundle\Form\AppointmentType', $appointment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($appointment);
            $em->flush();

            return $this->redirectToRoute('appointment_show', array('id' => $appointment->getId()));
        }

        return $this->render('appointment/new.html.twig', array(
            'appointment' => $appointment,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a appointment entity.
     *
     */
    public function showAction(Appointment $appointment)
    {
        $deleteForm = $this->createDeleteForm($appointment);

        return $this->render('appointment/show.html.twig', array(
            'appointment' => $appointment,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing appointment entity.
     *
     */
    public function editAction(Request $request, Appointment $appointment)
    {
        $deleteForm = $this->createDeleteForm($appointment);
        $editForm = $this->createForm('MainBundle\Form\AppointmentType', $appointment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('appointment_edit', array('id' => $appointment->getId()));
        }

        return $this->render('appointment/edit.html.twig', array(
            'appointment' => $appointment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a appointment entity.
     *
     */
    public function deleteAction(Request $request, Appointment $appointment)
    {
        $form = $this->createDeleteForm($appointment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($appointment);
            $em->flush();
        }

        return $this->redirectToRoute('appointment_index');
    }

    /**
     * Creates a form to delete a appointment entity.
     *
     * @param Appointment $appointment The appointment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Appointment $appointment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('appointment_delete', array('id' => $appointment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function mesrendezvousAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $offices = $em->getRepository("MainBundle:Office")->FindAll();
        $user=$this->getUser();

/*        $id_user=$request->get('id_user');*/
        $appointments =  $em->getRepository("MainBundle:Appointment")->findAll();
        $final=[];
        foreach ($appointments as $appointment)
        {  $pet=$appointment->getPet();
            if($pet->getOwner()==$user){ array_push($final,$appointment);}

        }



        return $this->render('MainBundle:Appointment:mesrendezvous.html.twig',array( "offices" => $offices ,'appointments'=>$final));

    }
    public function afficheofficeAction(Request $request)
    {

        $user=$this->getUser();

        $id=$request->get('id');
        $em = $this->getDoctrine()->getManager();
        $office = $em->getRepository("MainBundle:Office")->find($id);
        $appointments =  $em->getRepository("MainBundle:Appointment")->findBy(['office'=>$office]);
        $pets =  $em->getRepository("MainBundle:Pet")->findBy(['owner'=>$user]);

        $final=[];
        foreach ($appointments as $appointment)
        {  $pet=$appointment->getPet();
            if($pet->getOwner()==$user){ array_push($final,$appointment);}

        }

        return $this->render('MainBundle:Appointment:afficheoffice.html.twig',array( "office" => $office,  "appointments" => $final,"pets"=>$pets));

    }
    public function ajoutrdvAction(Request $request )
    {
        $appointment = new Appointment();
        $id_office=$request->get('id');
        $em = $this->getDoctrine()->getManager();

        $office =  $em->getRepository("MainBundle:Office")->find($id_office);


        if ('POST' == $request->getMethod()) {
            $em = $this->getDoctrine()->getManager();

            $appointment->setOffice( $office);
            $date = $request->get('date');

            $appointment->setDate(new \DateTime($date));
            $pet =  $em->getRepository("MainBundle:Pet")->find($request->get('animal'));


            $appointment->setPet($pet);
           $appointment->setDescription($request->get('description'));



            $em->persist($appointment);
            $em->flush();



        }


        return $this->redirectToRoute('afficheoffice',array( "id" => $id_office));

    }


    public function SupprimerRdvAction(Request $request){


        $id_rdv=$request->get('id_rdv');
        $em=$this->getDoctrine()->getManager();
        $rdv = $em->getRepository("MainBundle:Appointment")->find($id_rdv);


        $office=$rdv->getOffice();
        $oid=$office->getID();
        $em->remove($rdv);
        $em->flush();


        return $this->redirectToRoute('afficheoffice',array( "id" => $oid));

    }
    public function myofficeappointmentAction(Request $request){

$user=$this->getUser();
        $em=$this->getDoctrine()->getManager();
        $office = $em->getRepository("MainBundle:Office")->findOneBy(['owner'=>$user]);
        $appointments=$em->getRepository("MainBundle:Appointment")->findBy(['office'=>$office]);
        return $this->render('MainBundle:Appointment:rdvVito.html.twig',array('appointments'=>$appointments));

    }
    public function pdfrdvAction($id)
    {           $em=$this->getDoctrine()->getManager();

        $appointment= $em->getRepository('MainBundle:Appointment')->findOneBy(['id' => $id]);

        $html = $this->renderView('MainBundle:Appointment:invitation.html.twig', array(
     'appointment'=>$appointment
        ));

        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            'rendez-vous.pdf'
        );
    }


}
