<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 01/06/2017
 * Time: 17:37
 */

namespace FProjectAdminBundle\Admin;


use FProjectBundle\Entity\PhaseFinale;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PhaseFinaleAdmin extends AbstractAdmin
{
    public function toString($object){
        return $object instanceof PhaseFinale
            ? $object->getLibelle()
            : 'Phase Finale';

    }

    public function configureFormFields(FormMapper $formMapper){

        $formMapper
            ->add('libelle')
        ;

    }

    public function configureListFields(ListMapper $listMapper){
        $listMapper->add('libelle')
        ->add('_action','actions',
            array(
                'actions' => array(
            'edit' => array(),
             'delete' => array(),
                )
            )
        );
    }

}