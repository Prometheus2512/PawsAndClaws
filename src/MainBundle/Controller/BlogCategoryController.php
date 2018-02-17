<?php

namespace MainBundle\Controller;

use Doctrine\DBAL\Types\TextType;
use MainBundle\Entity\BlogCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class BlogCategoryController extends Controller
{
    public function addcategoryAction(Request $request)
    {
        $blogcategory= new BlogCategory();
        $form = $this->createFormBuilder($blogcategory)
            ->add("type", \Symfony\Component\Form\Extension\Core\Type\TextType::class)


            ->add("save", SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $form->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($blogcategory);
            $manager->flush();
            return $this->redirectToRoute("addBlog");
        }
        return $this->render("@Main/Blog/addBlogCategory.html.twig",["form"=>$form->createView()]);
    }
}
