<?php

namespace Inass\EleccionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NovedadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('evento', null, array('attr' => array('class' => 'k-textbox','rows' => 6)))
            ->add('accion', null, array('attr' => array('class' => 'k-textbox', 'rows' => 6)))
            ->add('estado')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Inass\EleccionBundle\Entity\Novedad'
        ));
    }

    public function getName()
    {
        return 'inass_eleccionbundle_novedadtype';
    }
}
