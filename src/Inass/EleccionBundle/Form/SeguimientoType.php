<?php

namespace Inass\EleccionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SeguimientoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('votos', null, array('attr' => array('class' => 'class="k-textbox"', 'size' => '5')))
            ->add('estado')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Inass\EleccionBundle\Entity\Seguimiento'
        ));
    }

    public function getName()
    {
        return 'inass_eleccionbundle_seguimientotype';
    }
}
