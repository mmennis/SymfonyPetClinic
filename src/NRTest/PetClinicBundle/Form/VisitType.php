<?php

namespace NRTest\PetClinicBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class VisitType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('visitDate')
            ->add('description')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('pet')
        ;
    }

    public function getName()
    {
        return 'nrtest_petclinicbundle_visittype';
    }
}
