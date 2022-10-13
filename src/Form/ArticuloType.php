<?php

namespace App\Form;

use App\Entity\Articulo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticuloType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('codsubfamiliarel')
            ->add('codigoean')
            ->add('referenciaproveedor')
            ->add('referenciamarca')
            ->add('descripcion')
            ->add('auxMargen')
            ->add('column1')
            ->add('margen')
            ->add('base')
            ->add('existenciasdisponible')
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
            ->add('imagen')
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
            ->add('codproveedorrel')
            ->add('codfamiliarel')
            ->add('codmarcarel')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Articulo::class,
        ]);
    }
}
