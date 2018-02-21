<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Adoption;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Adoption controller.
 *
 */
class AdoptionController extends Controller
{
    /**
     * Lists all adoption entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $adoptions = $em->getRepository('MainBundle:Adoption')->findAll();

        return $this->render('adoption/index.html.twig', array(
            'adoptions' => $adoptions,
        ));
    }

    /**
     * Creates a new adoption entity.
     *
     */
    public function newAction(Request $request)
    {
        $adoption = new Adoption();
        $form = $this->createForm('MainBundle\Form\AdoptionType', $adoption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($adoption);
            $em->flush();

            return $this->redirectToRoute('adoption_show', array('id' => $adoption->getId()));
        }

        return $this->render('adoption/new.html.twig', array(
            'adoption' => $adoption,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a adoption entity.
     *
     */
    public function showAction(Adoption $adoption)
    {
        $deleteForm = $this->createDeleteForm($adoption);

        return $this->render('adoption/show.html.twig', array(
            'adoption' => $adoption,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing adoption entity.
     *
     */
    public function editAction(Request $request, Adoption $adoption)
    {
        $deleteForm = $this->createDeleteForm($adoption);
        $editForm = $this->createForm('MainBundle\Form\AdoptionType', $adoption);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adoption_edit', array('id' => $adoption->getId()));
        }

        return $this->render('adoption/edit.html.twig', array(
            'adoption' => $adoption,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a adoption entity.
     *
     */
    public function deleteAction(Request $request, Adoption $adoption)
    {
        $form = $this->createDeleteForm($adoption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($adoption);
            $em->flush();
        }

        return $this->redirectToRoute('adoption_index');
    }

    /**
     * Creates a form to delete a adoption entity.
     *
     * @param Adoption $adoption The adoption entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Adoption $adoption)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adoption_delete', array('id' => $adoption->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
