<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Pet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Pet controller.
 *
 */
class PetController extends Controller
{
    /**
     * Lists all pet entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pets = $em->getRepository('MainBundle:Pet')->findAll();

        return $this->render('pet/index.html.twig', array(
            'pets' => $pets,
        ));
    }
    public function adoptioncenterAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pets = $em->getRepository('MainBundle:Pet')->findBy(['status'=>1]);

        return $this->render('pet/adoptioncenter.html.twig', array(
            'pets' => $pets,
        ));
    }


    /**
     * Creates a new pet entity.
     *
     */
    public function newAction(Request $request)
    {
        $pet = new Pet();
        $form = $this->createForm('MainBundle\Form\PetType', $pet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $em = $this->getDoctrine()->getManager();
            $em->persist($pet);
            $pet->setOwner($user);
            $em->flush();

            return $this->redirectToRoute('pet_show', array('id' => $pet->getId()));
        }

        return $this->render('pet/new.html.twig', array(
            'pet' => $pet,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a pet entity.
     *
     */
    public function showAction(Pet $pet)
    {
        $deleteForm = $this->createDeleteForm($pet);

        return $this->render('pet/show.html.twig', array(
            'pet' => $pet,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pet entity.
     *
     */
    public function editAction(Request $request, Pet $pet)
    {
        $deleteForm = $this->createDeleteForm($pet);
        $editForm = $this->createForm('MainBundle\Form\PetType', $pet);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pet_edit', array('id' => $pet->getId()));
        }

        return $this->render('pet/edit.html.twig', array(
            'pet' => $pet,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a pet entity.
     *
     */
    public function deleteAction(Request $request, Pet $pet)
    {
        $form = $this->createDeleteForm($pet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pet);
            $em->flush();
        }

        return $this->redirectToRoute('pet_index');
    }

    /**
     * Creates a form to delete a pet entity.
     *
     * @param Pet $pet The pet entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pet $pet)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pet_delete', array('id' => $pet->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function toAdoptAction( Pet $pet)
    {
        $em = $this->getDoctrine()->getManager();
        $pet = $em->getRepository('MainBundle:Pet')->find($pet);

        if ($pet) {
            $pet->setStatus(1);
            $em->flush();
        }


        return $this->render('pet/show.html.twig', array(
            'pet' => $pet,
            ));
    }
    public function retrieveAction( Pet $pet)
    {
        $em = $this->getDoctrine()->getManager();
        $pet = $em->getRepository('MainBundle:Pet')->find($pet);

        if ($pet) {
            $pet->setStatus(0);
            $em->flush();
        }


        return $this->render('pet/show.html.twig', array(
            'pet' => $pet,
        ));
    }
    public function adoptrequestAction( Pet $pet)
    {
        $em = $this->getDoctrine()->getManager();
        $pet = $em->getRepository('MainBundle:Pet')->find($pet);

        if ($pet) {
            $user = $this->getUser();
            $pet->setNewowner($user);
            $pet->setStatus(2);
            $em->flush();
        }


        return $this->render('pet/show.html.twig', array(
            'pet' => $pet,
        ));
    }
    public function acceptrequestAction( Pet $pet)
    {
        $em = $this->getDoctrine()->getManager();
        $pet = $em->getRepository('MainBundle:Pet')->find($pet);

        if ($pet) {
            $pet->setOwner($pet->getNewowner());
            $pet->setNewowner(null);
            $pet->setStatus(0);
            $em->flush();
        }


        return $this->render('pet/show.html.twig', array(
            'pet' => $pet,
        ));
    }
}
