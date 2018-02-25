<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class ArticleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')
            ->add('summary',TextareaType::class, array(
                'attr' => array('style' => 'width: 400px;height:100px') ,
            ))
            ->add('subtitle')
            ->add('brochure', FileType::class, array('label' => 'Image','data_class' => null))
            ->add('category', ChoiceType::class, array(
                'choices' => array(
                    'Pet Stories' => 'Pet Stories',
                    'Pet Advice' => 'Pet Advice',
                    'Funny Pets' => 'Funny Pets',

                )))
            ->add('content',TextareaType::class, array(
                'attr' => array('style' => 'width: 400px;height:400px') ,
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\Article'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mainbundle_article';
    }


}
