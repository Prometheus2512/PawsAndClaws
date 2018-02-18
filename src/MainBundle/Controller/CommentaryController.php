<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Commentary;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Commentary controller.
 *
 */
class CommentaryController extends Controller
{
    /**
     * Lists all commentary entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commentaries = $em->getRepository('MainBundle:Commentary')->findAll();

        return $this->render('commentary/index.html.twig', array(
            'commentaries' => $commentaries,
        ));
    }

    /**
     * Creates a new commentary entity.
     *
     */
    public function newAction(Request $request)
    {
        $commentary = new Commentary();
        $form = $this->createForm('MainBundle\Form\CommentaryType', $commentary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentary);
            $em->flush();

            return $this->redirectToRoute('commentary_show', array('id' => $commentary->getId()));
        }

        return $this->render('commentary/new.html.twig', array(
            'commentary' => $commentary,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a commentary entity.
     *
     */
    public function showAction(Commentary $commentary)
    {
        $deleteForm = $this->createDeleteForm($commentary);

        return $this->render('commentary/show.html.twig', array(
            'commentary' => $commentary,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing commentary entity.
     *
     */
    public function editAction(Request $request, Commentary $commentary)
    {
        $deleteForm = $this->createDeleteForm($commentary);
        $editForm = $this->createForm('MainBundle\Form\CommentaryType', $commentary);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commentary_edit', array('id' => $commentary->getId()));
        }

        return $this->render('commentary/edit.html.twig', array(
            'commentary' => $commentary,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a commentary entity.
     *
     */
    public function deleteAction(Request $request, Commentary $commentary)
    {
        $form = $this->createDeleteForm($commentary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($commentary);
            $em->flush();
        }

        return $this->redirectToRoute('commentary_index');
    }

    /**
     * Creates a form to delete a commentary entity.
     *
     * @param Commentary $commentary The commentary entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Commentary $commentary)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('commentary_delete', array('id' => $commentary->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
