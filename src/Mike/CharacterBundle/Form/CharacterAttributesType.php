<?php

namespace Mike\CharacterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CharacterAttributesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('character', 'entity', array('required' => TRUE, 'class' => 'MikeCharacterBundle:Characters'))
            ->add('attribute', 'entity', array('required' => TRUE, 'class' => 'MikeCharacterBundle:Attributes'))
            ->add('value')

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mike\CharacterBundle\Entity\CharacterAttributes'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mike_characterbundle_characterattributes';
    }
}
