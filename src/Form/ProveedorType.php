<?php

namespace App\Form;

use App\Entity\Proveedor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProveedorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('razonsocial')
            ->add('nif')
            ->add('domicilio')
            ->add('codpostal')
            ->add('poblacion')
            ->add('provincia')
            ->add('email')
            ->add('www')
            ->add('tfno1')
            ->add('tfno2')
            ->add('fax')
            ->add('movil')
            ->add('cuenta')
            ->add('cuentapago')
            ->add('ivapercent')
            ->add('ab')
            ->add('codpaisOficial')
            ->add('nifpaisresidencia')
            ->add('claveidenpaisresidencia')
            ->add('contabIntracom')
            ->add('tieneRe')
            ->add('esinversionsujetopasivo')
            ->add('pais')
            ->add('codfp')
            ->add('tipogasto')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Proveedor::class,
        ]);
    }
}
