<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Complaint;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Complaint controller.
 *
 */
class ComplaintController extends Controller
{
    /**
     * Lists all complaint entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $complaints = $em->getRepository('MainBundle:Complaint')->findAll();

        return $this->render('complaint/index.html.twig', array(
            'complaints' => $complaints,
        ));
    }

    /**
     * Creates a new complaint entity.
     *
     */
    public function newAction(Request $request)
    {
        $complaint = new Complaint();
        $form = $this->createForm('MainBundle\Form\ComplaintType', $complaint);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($complaint);
            $em->flush();

            return $this->redirectToRoute('complaint_show', array('id' => $complaint->getId()));
        }

        return $this->render('complaint/new.html.twig', array(
            'complaint' => $complaint,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a complaint entity.
     *
     */
    public function showAction(Complaint $complaint)
    {
        $deleteForm = $this->createDeleteForm($complaint);

        return $this->render('complaint/show.html.twig', array(
            'complaint' => $complaint,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing complaint entity.
     *
     */
    public function editAction(Request $request, Complaint $complaint)
    {
        $deleteForm = $this->createDeleteForm($complaint);
        $editForm = $this->createForm('MainBundle\Form\ComplaintType', $complaint);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('complaint_edit', array('id' => $complaint->getId()));
        }

        return $this->render('complaint/edit.html.twig', array(
            'complaint' => $complaint,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a complaint entity.
     *
     */
    public function deleteAction(Request $request, Complaint $complaint)
    {
        $form = $this->createDeleteForm($complaint);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($complaint);
            $em->flush();
        }

        return $this->redirectToRoute('complaint_index');
    }

    /**
     * Creates a form to delete a complaint entity.
     *
     * @param Complaint $complaint The complaint entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Complaint $complaint)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('complaint_delete', array('id' => $complaint->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function mycomplaintsAction()
    {

        $user =$this->getUser();
        $em = $this->getDoctrine()->getManager();

        $complaints = $em->getRepository('MainBundle:Complaint')->findAll();
        $final=[];
        foreach ($complaints as $complaint)
        {  $product=$complaint->getProduct();
            if($product->getOwner()==$user){ array_push($final,$complaint);}

        }

        return $this->render('complaint/mycomplaints.html.twig', array(
            'complaints' => $final,
        ));
    }
}
