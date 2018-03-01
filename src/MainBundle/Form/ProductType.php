<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
                ->add('price')
                ->add('description')
                ->add('aimedpets', ChoiceType::class, array(
                    'choices' => array(
                        'Dog' => 'Dog',
                        'Cat' => 'Cat',
                        'Bird' => 'Bird',
                        'Fish' => 'Fish',
                        'Other' => 'Other',
                    )))
                ->add('discount', ChoiceType::class, array(
                    'choices' => array(
                        'none' => 0 ,
                        '10' => 10,
                        '20' => 20,
                        '30' => 30,
                        '40' => 40,
                        '50' => 50,
                        '60' => 60,
                        '70' => 70,
                        '80' => 80,
                    )))
                ->add('category')
         ->add('brochure', FileType::class, array('label' => 'image ','data_class' => null));
        ;
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\Product'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mainbundle_product';
    }


}
