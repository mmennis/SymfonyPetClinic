<?php

namespace NRTest\PetClinicBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PetTypeType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    public function getName()
    {
        return 'nrtest_petclinicbundle_pettypetype';
    }
}
