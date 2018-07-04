<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 13/02/2017
 * Time: 16:27
 */

namespace FProjectAdminBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ImageFormType extends AbstractType
{

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(
            array(
                'type_field',
                'image_field',
                'image_prefix'
            )
        );
    }


    public function finishView(FormView $view, FormInterface $form, array $options)
    {

        $view->vars['type_field'] = $options['type_field'];
        $view->vars['image_field'] = $options['image_field'];
        $view->vars['image_prefix'] = $options['image_prefix'];
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'image_form';
    }
}