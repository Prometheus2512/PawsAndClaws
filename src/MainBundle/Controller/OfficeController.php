<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Appointment;
use MainBundle\Entity\Office;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Office controller.
 *
 */
class OfficeController extends Controller
{
    /**
     * Lists all office entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $offices = $em->getRepository('MainBundle:Office')->findAll();

        return $this->render('office/index.html.twig', array(
            'offices' => $offices,
        ));
    }

    /**
     * Creates a new office entity.
     *
     */
    public function newAction(Request $request)
    {
        $office = new Office();
        $form = $this->createForm('MainBundle\Form\OfficeType', $office);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $userManager = $this->get('fos_user.user_manager');
$user=$this->getUser();
$uid=$user->getId();
            // Use findUserby, findUserByUsername() findUserByEmail() findUserByUsernameOrEmail, findUserByConfirmationToken($token) or findUsers()
            $user = $userManager->findUserBy(['id' => $uid]);

            // Add the role that you want !
            $user->addRole("ROLE_VETERINARY");
            // Update user roles
            $userManager->updateUser($user);
            /*the user will get veterinary as a role as soon as he creates his office*/


            $em = $this->getDoctrine()->getManager();
            $office->setOwner($user);
            $em->persist($office);
            $em->flush();

            return $this->redirectToRoute('office_show', array('id' => $office->getId()));
        }

        return $this->render('office/new.html.twig', array(
            'office' => $office,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a office entity.
     *
     */
    public function showAction(Office $office,Request $request)
    {
        $deleteForm = $this->createDeleteForm($office);
        $em = $this->getDoctrine()->getManager();

        $appointments = $em->getRepository('MainBundle:Appointment')->findBy(['office'=>$office]);
        $appointment = new Appointment();
        $form = $this->createForm('MainBundle\Form\AppointmentType', $appointment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($appointment);
            $appointment->setOffice($office);
            $em->flush();

        }



        return $this->render('office/show.html.twig', array(
            'office' => $office,
            'delete_form' => $deleteForm->createView(),
            'appointment' => $appointment,
            'form' => $form->createView(),
            'appointments'=>$appointments
        ));
    }
    public function myofficeAction()
    {

        $em = $this->getDoctrine()->getManager();
$user=$this->getUser();
$uid=$user->getId();
        $office= $em->getRepository('MainBundle:Office')->findOneBy(['owner'=>$uid]);
/*        $appointment = new Appointment();*/
      /*  $form = $this->createForm('MainBundle\Form\AppointmentType', $appointment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($appointment);
            $appointment->setOffice($office);
            $em->flush();

        }
*/
        $appointments= $em->getRepository('MainBundle:Appointment')->findBy(['office'=>$office]);

        $deleteForm = $this->createDeleteForm($office);


        return $this->render('office/show.html.twig', array(
            'office' => $office,
            'delete_form' => $deleteForm->createView(),
/*           'form' => $form->createView(),*/
            'appointments'=>$appointments
        ));
    }

    public function validateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $appointment= $em->getRepository('MainBundle:Appointment')->find($id);

        if ($appointment) {

            $appointment->setValidated('1');
            $em->flush();
        }


   $office=$appointment->getOffice();


return $this->redirectToRoute('myofficeappointment', array('id' => $office->getId()));  }
    public function unvalidateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $appointment= $em->getRepository('MainBundle:Appointment')->find($id);

        if ($appointment) {

            $appointment->setValidated('0');
            $em->flush();
        }


        $office=$appointment->getOffice();


        return $this->redirectToRoute('myofficeappointment', array('id' => $office->getId()));  }


    /**
     * Displays a form to edit an existing office entity.
     *
     */
    public function editAction(Request $request, Office $office)
    {
        $deleteForm = $this->createDeleteForm($office);
        $editForm = $this->createForm('MainBundle\Form\OfficeType', $office);
        $editForm->handleRequest($request);


        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('office_edit', array('id' => $office->getId()));
        }

        return $this->render('office/edit.html.twig', array(
            'office' => $office,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a office entity.
     *
     */
    public function deleteAction(Request $request, Office $office)
    {
        $form = $this->createDeleteForm($office);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $appointments= $em->getRepository('MainBundle:Appointment')
                ->findBy(['office'=>$office]);


            foreach ($appointments as $appointment ) {
                $em->remove($appointment);
            }

            $em->remove($office);
            $em->flush();
        }

        return $this->redirectToRoute('office_index');
    }

    /**
     * Creates a form to delete a office entity.
     *
     * @param Office $office The office entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Office $office)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('office_delete', array('id' => $office->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
