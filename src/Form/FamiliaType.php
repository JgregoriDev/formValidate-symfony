<?php

namespace App\Form;

use App\Entity\Familia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FamiliaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('margen')
            ->add('ivapercent')
            ->add('esmanoobra')
            ->add('iniciocodean')
            ->add('re')
            ->add('imagen')
            ->add('esanimales')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Familia::class,
        ]);
    }
}
