<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 24/04/2017
 * Time: 11:22
 */

namespace FProjectAdminBundle\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CompositionAdmin extends AbstractAdmin
{
    protected function configureListFields(ListMapper $listMapper){
        $listMapper
            ->add('idConfrontation')
            ->add('idJoueur')
            ->add('idPoste');
    }

    protected function configureFormFields(FormMapper $formMapper){

        $formMapper

            ->add('idFormation', 'sonata_type_model', array(
                    'property' => 'libelle',
                    'class' => 'FProjectBundle\Entity\Formation',
                    'empty_value' => false,
                    'label' => 'Formation',
                    'required' => true
                )
            )
            ->add('idClub', 'sonata_type_model', array(
                    'property' => 'nom',
                    'class' => 'FProjectBundle\Entity\Club',
                    'empty_value' => false,
                    'label' => 'Club',
                    'required' => true
                )
            )->add('idJoueur1', 'sonata_type_model', array(
                        'property' => 'nom',
                        'class' => 'FProjectBundle\Entity\Joueur',
                        'empty_value' => false,
                        'label' => 'Joueur 1',
                        'required' => true
                    )
                )->add('idJoueur2', 'sonata_type_model', array(
                    'property' => 'nom',
                    'class' => 'FProjectBundle\Entity\Joueur',
                    'empty_value' => false,
                    'label' => 'Joueur 2',
                    'required' => true
                )
            )
            ->add('idJoueur3', 'sonata_type_model', array(
                    'property' => 'nom',
                    'class' => 'FProjectBundle\Entity\Joueur',
                    'empty_value' => false,
                    'label' => 'Joueur 3',
                    'required' => true
                )
            )
            ->add('idJoueur4', 'sonata_type_model', array(
                    'property' => 'nom',
                    'class' => 'FProjectBundle\Entity\Joueur',
                    'empty_value' => false,
                    'label' => 'Joueur 4',
                    'required' => true
                )
            )
            ->add('idJoueur5', 'sonata_type_model', array(
                    'property' => 'nom',
                    'class' => 'FProjectBundle\Entity\Joueur',
                    'empty_value' => false,
                    'label' => 'Joueur 5',
                    'required' => true
                )
            )
            ->add('idJoueur6', 'sonata_type_model', array(
                    'property' => 'nom',
                    'class' => 'FProjectBundle\Entity\Joueur',
                    'empty_value' => false,
                    'label' => 'Joueur 6',
                    'required' => true
                )
            )
            ->add('idJoueur7', 'sonata_type_model', array(
                    'property' => 'nom',
                    'class' => 'FProjectBundle\Entity\Joueur',
                    'empty_value' => false,
                    'label' => 'Joueur 7',
                    'required' => true
                )
            )
            ->add('idJoueur8', 'sonata_type_model', array(
                    'property' => 'nom',
                    'class' => 'FProjectBundle\Entity\Joueur',
                    'empty_value' => false,
                    'label' => 'Joueur 8',
                    'required' => true
                )
            )
            ->add('idJoueur9', 'sonata_type_model', array(
                    'property' => 'nom',
                    'class' => 'FProjectBundle\Entity\Joueur',
                    'empty_value' => false,
                    'label' => 'Joueur 9',
                    'required' => true
                )
            )
            ->add('idJoueur10', 'sonata_type_model', array(
                    'property' => 'nom',
                    'class' => 'FProjectBundle\Entity\Joueur',
                    'empty_value' => false,
                    'label' => 'Joueur 10',
                    'required' => true
                )
            )
            ->add('idJoueur11', 'sonata_type_model', array(
                    'property' => 'nom',
                    'class' => 'FProjectBundle\Entity\Joueur',
                    'empty_value' => false,
                    'label' => 'Joueur 11',
                    'required' => true
                )
            )


                ;
            }


}