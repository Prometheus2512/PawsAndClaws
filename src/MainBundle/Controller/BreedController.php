<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Breed;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Breed controller.
 *
 */
class BreedController extends Controller
{
    /**
     * Lists all breed entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $breeds = $em->getRepository('MainBundle:Breed')->findAll();

        return $this->render('breed/index.html.twig', array(
            'breeds' => $breeds,
        ));
    }

    /**
     * Creates a new breed entity.
     *
     */
    public function newAction(Request $request)
    {
        $breed = new Breed();
        $form = $this->createForm('MainBundle\Form\BreedType', $breed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($breed);
            $em->flush();

            return $this->redirectToRoute('breed_show', array('id' => $breed->getId()));
        }

        return $this->render('breed/new.html.twig', array(
            'breed' => $breed,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a breed entity.
     *
     */
    public function showAction(Breed $breed)
    {
        $deleteForm = $this->createDeleteForm($breed);

        return $this->render('breed/show.html.twig', array(
            'breed' => $breed,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing breed entity.
     *
     */
    public function editAction(Request $request, Breed $breed)
    {
        $deleteForm = $this->createDeleteForm($breed);
        $editForm = $this->createForm('MainBundle\Form\BreedType', $breed);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('breed_edit', array('id' => $breed->getId()));
        }

        return $this->render('breed/edit.html.twig', array(
            'breed' => $breed,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a breed entity.
     *
     */
    public function deleteAction(Request $request, Breed $breed)
    {
        $form = $this->createDeleteForm($breed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($breed);
            $em->flush();
        }

        return $this->redirectToRoute('breed_index');
    }

    /**
     * Creates a form to delete a breed entity.
     *
     * @param Breed $breed The breed entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Breed $breed)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('breed_delete', array('id' => $breed->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
