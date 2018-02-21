<?php

namespace MainBundle\Controller;

use MainBundle\Entity\ProductCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class ProductCategoryController extends Controller
{
    public function addProductCategoryAction(Request $request)
    {
        $c = new ProductCategory();
        $form = $this->createFormBuilder($c)
            ->add("name", TextType::class)
            ->add("add", SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $c = $form->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($c);
            $manager->flush();
            return $this->redirectToRoute("add_product_category");
        }

        return $this->render("@Main/admin/ProductGestion/addproductcategory.html.twig", ["form" => $form->createView()]);
    }

}
