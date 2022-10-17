<?php

namespace App\Form;

use App\Entity\Articulo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ArticuloType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('codigoean')
            ->add('referenciaproveedor')
            ->add('referenciamarca')
            ->add('descripcion')
            ->add('auxMargen')
            ->add('margen')
            ->add('base')
            ->add('existenciasdisponibles')
            ->add('pvpOfertaMostrador')
            ->add('pvp')
            ->add('pvp2')
            ->add('codigo')
            ->add('esmanoobra')
            ->add('udsUltimaentrada')
            ->add('base2')
            ->add('favorito')
            ->add('posibleb')
            ->add('codartGranel')
            ->add('udXUdgrannel')
            // ->add('imagen')
            ->add('img', FileType::class, [
                "label" => "Selecciona una imagen",
                "required" => false,
                "mapped" => false,
                // "multiple" => true,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/png',
                            'image/jpg',
                            'image/jpeg'
                        ],

                        'mimeTypesMessage' => 'Por favor sube una imagen con formato png o jpg',
                    ])
                ],
            ])
            ->add('ivapercent')
            ->add('nordenMostrar')
            ->add('intrastat')
            ->add('umedida')
            ->add('peso')
            ->add('reqEq')
            ->add('codcategoria')
            ->add('codsubcategoria')
            ->add('idwoocommerce')
            ->add('caractecnicas')
            ->add('pvd')
            ->add('nomcategoria')
            ->add('nomsubcategoria')
            ->add('codproveedor')
            ->add('codsubfamilia')
            ->add('codmarcar');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Articulo::class,
        ]);
    }
}
