<?php

namespace NRTest\PetClinicBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class VetType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('specialties')
        ;
    }

    public function getName()
    {
        return 'nrtest_petclinicbundle_vettype';
    }
}
