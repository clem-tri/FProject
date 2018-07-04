<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 09/02/2017
 * Time: 14:42
 */

namespace FProjectAdminBundle\Admin;


use FProjectBundle\Entity\Poste;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class PosteAdmin extends AbstractAdmin
{
    public function toString($object)
    {
        return $object instanceof Poste
            ? $object->getLibelle()
            : 'Poste';
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('code')
            ->add('libelle');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('libelle');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('code')
            ->add('libelle')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                )))
       ;
    }

}