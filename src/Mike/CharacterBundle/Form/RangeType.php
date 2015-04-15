<?php

namespace Mike\CharacterBundle\Form;

use Symfony\Component\Form\AbstractType as FormAbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * ImagePreviewType
 *
 */
class RangeType extends FormAbstractType
{

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'max'         => '',
            'min'         => '',
            'unit'         => '',
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['max'] = $options['max'];
        $view->vars['min'] = $options['min'];
        $view->vars['unit'] = $options['unit'];
    }

//    /**
//     * {@inheritDoc}
//     */
//    public function buildForm(FormBuilder $builder, array $options)
//    {
//        $builder
//            ->setAttribute('max', $options['max'])
//            ->setAttribute('min', $options['min'])
//        ;
//    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'range';
    }

    public function getParent()
    {
        return 'integer';
    }
}