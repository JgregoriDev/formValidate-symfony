<?php

namespace App\Form;

use App\Entity\Articulo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ArticuloType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('codigoean', null, [
                'label' => 'Código ean:'
            ])
            ->add('referenciaproveedor', null, [
                'label' => 'Referencia proveedor:'
            ])
            ->add('referenciamarca', null, [
                'label' => 'Referencia marca:'
            ])
            ->add('descripcion', TextareaType::class, [
                'label' => 'Descripción:'
            ])
            ->add('auxMargen', IntegerType::class, [
                
                'label' => 'Margen auxiliar:'
            ])
            ->add('margen', IntegerType::class, [
                
                'label' => 'Margen:'
            ])
            ->add('base', IntegerType::class, [
                
                'label' => 'Base:'
            ])
            ->add('existenciasdisponibles', IntegerType::class, [
                
                'label' => 'Existencias disponibles:'
            ])
            ->add('pvpOfertaMostrador', IntegerType::class, [
                
                'label' => 'PVP oferta en mostrador:'
            ])
            ->add('pvp', IntegerType::class, [
                
                'label' => 'PVP:'
            ])
            ->add('pvp2', IntegerType::class, [
                
                'label' => 'PVP2:'
            ])
            ->add('codigo', null, [
                'label' => 'Código:'
            ])
            ->add('esmanoobra', null, [
                'label' => 'Ha habido mano de obra'
            ])
            ->add('udsUltimaentrada', IntegerType::class, [
                
                'label' => 'Unidades recibidas en la última entrada :'
            ])
            ->add('base2', null, [
                'label' => 'Base2:'
            ])
            ->add('favorito', null, [
                'label' => 'Artículo favorito'
            ])
            ->add('posibleb', null, [
                'label' => 'posible b'
            ])
            ->add('codartGranel', null, [
                'label' => 'Código artículo granel:'
            ])
            ->add('udXUdgrannel', null, [
                'label' => 'Unidades por granel:'
            ])
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
            ->add('ivapercent', IntegerType::class, [
                
                'label' => 'IVA porcentaje:'
            ])
            ->add('nordenMostrar', IntegerType::class, [
                
                'label' => 'Número de orden a la hora de mostrar:'
            ])
            ->add('intrastat', null, [
                'label' => 'intrastat:'
            ])
            ->add('umedida', null, [
                'label' => 'Unidad de medida:'
            ])
            ->add('peso', IntegerType::class, [
                
                'label' => 'Peso:'
            ])
            ->add('reqEq', null, [
                'label' => 'Unidades por granel:'
            ])
            ->add('codcategoria', IntegerType::class, [
                
                'label' => 'Código de categoria:'
            ])
            ->add('nomcategoria', null, [
                'label' => 'Nombre categoría:'
            ])
            ->add('codsubcategoria', IntegerType::class, [
                
                'label' => 'Código de subcategoria:'
            ])
            ->add('nomsubcategoria', null, [
                'label' => 'Nombre subcategoría:'
            ])
            ->add('idwoocommerce', IntegerType::class, [
                
                'label' => 'idwoocommerce:'
            ])
            ->add('caractecnicas', TextareaType::class, [
                'label' => 'Características técnicas:'
            ])
            ->add('pvd', IntegerType::class, [
                
                'label' => 'PVD:'
            ])
            ->add('codproveedor', null, [
                'label' => 'Código de proveedor:'
            ])
            ->add('codsubfamilia', null, [
                'label' => 'Código de la subfamilia:'
            ])
            ->add('codmarcar', null, [
                'label' => 'Código de la marca:'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Articulo::class,
        ]);
    }
}
