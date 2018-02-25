<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
            /*                ->add('type')*/
            ->add('type', ChoiceType::class, array(
                'choices' => array(
                    'Dog' => 'Dog',
                    'Cat' => 'Cat',
                    'Bird' => 'Bird',
                    'Fish' => 'Fish',
                    'Other' => 'Other',
                )))
            ->add('gender', ChoiceType::class, array(
                'choices' => array(
                    'male' => 'male',
                    'female' => 'female',
                )))
            ->add('age')
            ->add('status', ChoiceType::class, array(
                'choices' => array(
                    'my own pet' => 0,
                    'offer for adoption center' => 1,
                )))
            ->add('breed')
            ->add('childfriendly', ChoiceType::class, array(
                'choices' => array(
                    'Yes he is' => true,
                    'No he is not' => false,
                )))
            ->add('inOrOut', ChoiceType::class, array(
                'choices' => array(
                    'yes he can' => true,
                    'no he can not' => false,
                )));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\Pet'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mainbundle_pet';
    }


}
