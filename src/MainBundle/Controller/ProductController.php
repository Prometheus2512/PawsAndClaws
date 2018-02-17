<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductController extends Controller
{
    public function addProductAction(Request $request)
    {
        $p = new Product();
        $form = $this->createFormBuilder($p)
            ->add("name", TextType::class)
            ->add("price", NumberType::class)
            ->add("description", TextareaType::class)
            ->add("promotion", NumberType::class)
            ->add("category",EntityType::class,[
                "class"=>"MainBundle\Entity\ProductCategory",
                "choice_label"=>"name",
                "expanded"=>false,
                "multiple"=>false
            ])
            ->add("add", SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $p = $form->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($p);
            $manager->flush();
            return $this->redirectToRoute("index_product");
        }

        return $this->render("@Main/admin/ProductGestion/addproduct.html.twig", ["form" => $form->createView()]);
    }

    public function indexProductAction()
    {
        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository("MainBundle:Product");
        $resultat = $repo->findAll();
        return $this->render("@Main/admin/ProductGestion/indexproducts.html.twig", ["products" => $resultat]);
    }

    public function deleteProductAction($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $resultat = $manager->find("MainBundle:Product", $id);
        if ($resultat == null) {
            throw new NotFoundHttpException("Not found");
        }
        $manager->remove($resultat);
        $manager->flush();
        return new Response("Deleted successfully");
    }

    public function editProductAction(Request $request, $id)
    {
        $manager = $this->getDoctrine()->getManager();
        $resultat = $manager->getRepository("MainBundle:Product")->find($id);

        $form = $this->createFormBuilder($resultat)
            ->add("name", TextType::class)
            ->add("price", NumberType::class)
            ->add("description", TextareaType::class)
            ->add("promotion", NumberType::class)
            ->add("category",EntityType::class,[
                "class"=>"MainBundle\Entity\ProductCategory",
                "choice_label"=>"name",
                "expanded"=>false,
                "multiple"=>false
            ])
            ->add("update", SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $p = $form->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($p);
            $manager->flush();
            return $this->redirectToRoute("index_product");
        }
        return $this->render("@Main/admin/ProductGestion/addproduct.html.twig", ["form" => $form->createView()]);
    }


}
