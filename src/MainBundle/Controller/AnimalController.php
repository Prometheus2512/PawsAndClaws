<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Animal;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Animal controller.
 *
 */
class AnimalController extends Controller
{
    /**
     * Lists all animal entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $animals = $em->getRepository('MainBundle:Animal')->findAll();

        return $this->render('animal/index.html.twig', array(
            'animals' => $animals,
        ));
    }

    /**
     * Creates a new animal entity.
     *
     */
    public function newAction(Request $request)
    {
        $animal = new Animal();
        $form = $this->createForm('MainBundle\Form\AnimalType', $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($animal);
            $em->flush();

            return $this->redirectToRoute('animal_show', array('id' => $animal->getId()));
        }

        return $this->render('animal/new.html.twig', array(
            'animal' => $animal,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a animal entity.
     *
     */
    public function showAction(Animal $animal)
    {
        $deleteForm = $this->createDeleteForm($animal);

        return $this->render('animal/show.html.twig', array(
            'animal' => $animal,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing animal entity.
     *
     */
    public function editAction(Request $request, Animal $animal)
    {
        $deleteForm = $this->createDeleteForm($animal);
        $editForm = $this->createForm('MainBundle\Form\AnimalType', $animal);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('animal_edit', array('id' => $animal->getId()));
        }

        return $this->render('animal/edit.html.twig', array(
            'animal' => $animal,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a animal entity.
     *
     */
    public function deleteAction(Request $request, Animal $animal)
    {
        $form = $this->createDeleteForm($animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($animal);
            $em->flush();
        }

        return $this->redirectToRoute('animal_index');
    }

    /**
     * Creates a form to delete a animal entity.
     *
     * @param Animal $animal The animal entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Animal $animal)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('animal_delete', array('id' => $animal->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
