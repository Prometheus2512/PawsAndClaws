<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/12/18
 * Time: 8:43 AM
 */


namespace MainBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('address');
        $builder->add('firstname');
        $builder->add('lastname');
        $builder->add('phonenumber');


    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
        /*'FOSUserBundleFormTypeRegistrationFormType';*/

    }

    public function getBlockPrefix()
    {
        return 'main_user_registration';
    }
}