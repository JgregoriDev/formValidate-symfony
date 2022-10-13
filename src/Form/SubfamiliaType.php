<?php

namespace App\Form;

use App\Entity\Subfamilia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubfamiliaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('codsubfamilia')
            ->add('nombre')
            ->add('imagen')
            ->add('codfamilia')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Subfamilia::class,
        ]);
    }
}
