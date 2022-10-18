<?php

namespace App\Form;

use App\Entity\Subfamilia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class SubfamiliaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('codsubfamilia')
            ->add('codsubfamilia',IntegerType::class,["label"=>"Codigo subfamilia:"])
            ->add('codfamilia')
            ->add('nombre')
            ->add('img',FileType::class, [
                'label' => 'Imagen',
                'mapped'=>false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Subfamilia::class,
        ]);
    }
}
