<?php

namespace MainBundle\Controller;

use MainBundle\Entity\wishlist;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Wishlist controller.
 *
 * @Route("wishlist")
 */
class wishlistController extends Controller
{
    /**
     * Lists all wishlist entities.
     *
     * @Route("/", name="wishlist_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $wishlists = $em->getRepository('MainBundle:wishlist')->findAll();

        return $this->render('wishlist/index.html.twig', array(
            'wishlists' => $wishlists,
        ));
    }
    public function addtowishlistAction($id)
    {
        $user=$this->getUser();
        $wishlist=new wishlist();
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('MainBundle:Product')->find($id);

        $em->persist($wishlist);
        $wishlist->setUser($user);
        $wishlist->setProduct($product);
        $em->flush();
        $wishlists = $em->getRepository('MainBundle:wishlist')->findAll();

        return $this->redirectToRoute('product_show', array('id' => $id));

    }
    public function deletefromwishlistAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $product = $em->getRepository('MainBundle:Product')->find($id);

        $wishlist = $em->getRepository('MainBundle:wishlist')->findOneBy(['user' => $user,'product'=>$product]);

        $em->remove($wishlist);
        $em->flush()
        ;

        return $this->redirectToRoute('product_show', array('id' => $id));

    }

    /**
     * Creates a new wishlist entity.
     *
     * @Route("/new", name="wishlist_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $wishlist = new Wishlist();
        $form = $this->createForm('MainBundle\Form\wishlistType', $wishlist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($wishlist);
            $em->flush();

            return $this->redirectToRoute('wishlist_show', array('id' => $wishlist->getId()));
        }

        return $this->render('wishlist/new.html.twig', array(
            'wishlist' => $wishlist,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a wishlist entity.
     *
     * @Route("/{id}", name="wishlist_show")
     * @Method("GET")
     */
    public function showAction(wishlist $wishlist)
    {
        $deleteForm = $this->createDeleteForm($wishlist);

        return $this->render('wishlist/show.html.twig', array(
            'wishlist' => $wishlist,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing wishlist entity.
     *
     * @Route("/{id}/edit", name="wishlist_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, wishlist $wishlist)
    {
        $deleteForm = $this->createDeleteForm($wishlist);
        $editForm = $this->createForm('MainBundle\Form\wishlistType', $wishlist);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('wishlist_edit', array('id' => $wishlist->getId()));
        }

        return $this->render('wishlist/edit.html.twig', array(
            'wishlist' => $wishlist,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a wishlist entity.
     *
     * @Route("/{id}", name="wishlist_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, wishlist $wishlist)
    {
        $form = $this->createDeleteForm($wishlist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($wishlist);
            $em->flush();
        }

        return $this->redirectToRoute('wishlist_index');
    }

    /**
     * Creates a form to delete a wishlist entity.
     *
     * @param wishlist $wishlist The wishlist entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(wishlist $wishlist)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('wishlist_delete', array('id' => $wishlist->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
