<?php

namespace App\Form;

use App\Entity\Familia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\File;

class FamiliaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('CodigoArticulo', NumberType::class,['mapped' => false])
            ->add('nombre')
            ->add('margen',IntegerType::class)
            ->add('ivapercent',IntegerType::class)
            ->add('esmanoobra')
            ->add('iniciocodean')
            ->add('re')
            ->add('img',FileType::class, [
                'label' => 'Imagen',
                'mapped'=>false,
                'required'=>false,
                
            ])
            // ->add('upload_imagen', FileType::class, [
            //     "mapped" => false,
            //     "label" => "Subir imagen",
            //     'constraints' => [
            //         new File([
            //             'maxSize' => '100k',
            //             'maxSizeMessage' => 'Sube una imagen como maximo de 100 kb',
            //             'mimeTypes' => [
            //                 'image/png',
            //                 'image/jpg',
            //                 'image/jpeg',
            //                 'image/avig',
            //                 'image/webp',
            //             ],

            //             'mimeTypesMessage' => 'Por favor sube una imagen tipo png, avif, webp o jpg',
            //         ])
            //     ],
            // ])
            ->add('esanimales');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Familia::class,
        ]);
    }
}
