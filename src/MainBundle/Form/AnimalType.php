<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
class AnimalType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')


            ->add('gender', ChoiceType::class, array(
                'choices'  => array('Male' => '1', 'Female' => '0'

                ),
            ))
            ->add('type', ChoiceType::class, array(
                'choices'  => array('Dog' => 'Dog', 'Cat' => 'Cat','Other'=>'Other'

                ),
            ))


            ->add('age')
            ->add('size')
            ->add('breed')
            ->add('spayed')
            ->add('liveWcats')
            ->add('homeTest')
            ->add('childFriend')
            ->add('Description');
            /*->add('status');*/

            /*->add('user');*/
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\Animal'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mainbundle_animal';
    }


}
