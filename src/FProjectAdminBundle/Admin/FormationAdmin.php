<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 24/04/2017
 * Time: 16:07
 */

namespace FProjectAdminBundle\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class FormationAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper){
        $formMapper->add('libelle');
    }

    protected function configureListFields(ListMapper $listMapper){

        $listMapper->add('libelle')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array()
                )
            ));
    }

}