<?php

namespace App\Form;

use App\Entity\Proveedor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProveedorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('razonsocial',TextareaType::class,[
                'label'=>'Razón social'
            ])
            ->add('nif',null,[
                'label'=>'NIF'
            ])
            ->add('domicilio',null,[
                'label'=>'Domicilio'
            ])
            ->add('codpostal',null,[
                'label'=>'Código postal'
            ])
            ->add('poblacion',null,[
                'label'=>'Población'
            ])
            ->add('provincia',null,[
                'label'=>'Provincia'
            ])
            ->add('email',null,[
                'label'=>'Correo electrónico'
            ])
            ->add('www',null,[
                'label'=>'Enlace web'
            ])
            ->add('tfno1',null,[
                'label'=>'Teléfono 1'
            ])
            ->add('tfno2',null,[
                'label'=>'Teléfono 2'
            ])
            ->add('fax',null,[
                'label'=>'Fax'
            ])
            ->add('movil',null,[
                'label'=>'Móvil'
            ])
            ->add('cuenta',null,[
                'label'=>'Cuenta'
            ])
            ->add('cuentapago',null,[
                'label'=>'Cuenta de pago'
            ])
            ->add('ivapercent',null,[
                'label'=>'Iva porcentaje'
            ])
            ->add('ab',null,[
                'label'=>'AB'
            ])
            ->add('codpaisOficial',null,[
                'label'=>'Código país oficial'
            ])
            ->add('nifpaisresidencia',null,[
                'label'=>'Nif pais residencia'
            ])
            ->add('claveidenpaisresidencia',null,[
                'label'=>'Clave id en país de residencia'
            ])
            ->add('contabIntracom',null,[
                'label'=>'Contab intracom'
            ])
            ->add('tieneRe',null,[
                'label'=>'Tiene re'
            ])
            ->add('esinversionsujetopasivo',null,[
                'label'=>'Sujeto pasivo'
            ])
            ->add('pais',null,[
                'label'=>'País'
            ])
            ->add('codfp',null,[
                'label'=>'Código forma de pago'
            ])
            ->add('tipogasto',null,[
                'label'=>'Tipo de gasto'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Proveedor::class,
        ]);
    }
}
