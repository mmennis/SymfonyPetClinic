<?php

namespace NRTest\PetClinicBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class OwnerType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('address')
            ->add('city')
            ->add('telephone')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    public function getName()
    {
        return 'nrtest_petclinicbundle_ownertype';
    }
}
