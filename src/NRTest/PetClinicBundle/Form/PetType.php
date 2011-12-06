<?php

namespace NRTest\PetClinicBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PetType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('birthDate')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('petType')
            ->add('owner')
        ;
    }

    public function getName()
    {
        return 'nrtest_petclinicbundle_pettype';
    }
}
