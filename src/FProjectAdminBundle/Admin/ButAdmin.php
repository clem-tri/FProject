<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 23/02/2017
 * Time: 17:34
 */

namespace FProjectAdminBundle\Admin;



use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class ButAdmin extends AbstractAdmin
{
    public function configureFormFields(FormMapper $formMapper){

        $formMapper
            ->add('ordre', IntegerType::class, array('attr' => array('min' => 1), 'required' => true))
           ->add('idJoueur', 'sonata_type_model', array(
               'property' => 'nom',
               'class' => 'FProjectBundle\Entity\Joueur',
               'label' => 'Buteur',
               'empty_value' => false,
               'required' => true))
           ->add('idClub', 'sonata_type_model', array(
               'property' => 'nom',
                'class' => 'FProjectBundle\Entity\Club',
               'empty_value' => false,
                'label' => 'Club',
                'required' => true
                )

            )
           ->add('idAssist', 'sonata_type_model', array(
                'property' => 'nom',
                'class' => 'FProjectBundle\Entity\Joueur',
                'empty_value' => '',
                'label' => 'Passeur décisif',
                'required' => false,


            ))
            ->add('minute', IntegerType::class, array('attr' => array('min' => 1, 'max' => 90), 'required' => true))
            ->add('minuteAdditionnelle', IntegerType::class, array('attr' => array('min' => 1, 'max' => 10, 'label' => 'Minute additionnelle'), 'required' => false))
            ->add('penalty')
            ->add('csc')
        ;

    }

}