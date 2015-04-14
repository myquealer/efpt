<?php

namespace Mike\CharacterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AttributesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('unit','text', array('required' => FALSE))
            ->add('min','number', array('required' => FALSE))
            ->add('max','number', array('required' => FALSE))
            ->add('type', 'entity', array('required' => TRUE, 'class' => 'MikeCharacterBundle:Types'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mike\CharacterBundle\Entity\Attributes'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mike_characterbundle_attributes';
    }
}
