<?php

namespace MainBundle\Controller;
use MainBundle\Entity\BlogCategory;
use MainBundle\Entity\Blog;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
    public function addBlogAction(Request $request)
    {
        $Blog = new Blog();


        $form = $this->createFormBuilder($Blog)
            ->add("titre", TextType::class)
            ->add("date", DateType::class)
            ->add("content", TextareaType::class)
            ->add("auteur", TextType::class)
            ->add("categories", EntityType::class, [
                "class" => "MainBundle\Entity\BlogCategory",
                "choice_label" => "type",
                "expanded" => false,
                "multiple" => false
            ])
            ->add("save", SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blog = $form->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($blog);
            $manager->flush();
            return $this->redirectToRoute("indexBlog");
        }

        return $this->render("@Main/Blog/addBlog.html.twig", ["form" => $form->createView()]);
    }


    public function indexBlogAction()
    {
        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository("MainBundle:Blog");
        $resultat = $repo->findAll();
        return $this->render("MainBundle:Blog:indexBlog.html.twig", ["blogs" => $resultat]);


    }
    public function deleteBlogAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($id);
            $em->flush();
        }

        return $this->redirectToRoute('indexBlog');
    }

    public function deleteAction($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $tobeupdated = $manager->find("MainBundle:Blog", $id);
        if ($tobeupdated == null){ throw new NonceExpiredException("No matches found");}
        $manager->remove($tobeupdated);
        $manager->flush();
        return $this->redirectToRoute("indexBlog");
    }


     public function updateBlogAction(Request $request,$id)
{
    $manager = $this->getDoctrine()->getManager();
    $toupdate = $manager->find("MainBundle:Blog", $id);
    $form = $this->createFormBuilder($toupdate)
        ->add("titre", TextType::class)
        ->add("date", DateType::class)
        ->add("content", TextareaType::class)
        ->add("auteur", TextType::class)
        ->add("categories", EntityType::class, [
            "class" => "MainBundle\Entity\BlogCategory",
            "choice_label" => "type",
            "expanded" => false,
            "multiple" => false
        ])
        ->add("Edit", SubmitType::class)
        ->getForm();

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $form->getData();

        $manager->persist($toupdate);
        $manager->flush();
        return $this->redirectToRoute("addBlog");
    }
    return $this->render("@Main/Blog/EditBlog.html.twig",  ["form" => $form->createView()]);

}


    public function findBlogbYcategoryAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        if ($request->isMethod('POST')) {
            $nom = $request->get('type');
            $repo = $manager->getRepository('MainBundle:Blog');
            /*            $res = $repo->findPostByUser(1);*/
            /*            $res = $repo->findPostsByUserType("user");*/
            $res = $repo->findBlogByCategory("type");
            //$res=$repo->findBy(['nom'=>$nom]);
            /*if ($res == null){
                throw new NotFoundHttpException("not found");}*/
            return $this->render('MainBundle:Blog:indexBlog.html.twig', ["blogs" => $res]);
        }

        return $this->render("@Main/Blog/search.html.twig", []);

    }
}