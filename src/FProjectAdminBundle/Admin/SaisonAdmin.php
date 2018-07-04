<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 21/02/2017
 * Time: 10:39
 */

namespace FProjectAdminBundle\Admin;


use FProjectBundle\Entity\Saison;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class SaisonAdmin extends AbstractAdmin
{
    public function toString($object)
    {
        return $object instanceof Saison
            ? $object->getLibelle()
            : 'Saison';
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('libelle');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('libelle');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('libelle')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                )))
        ;
    }

}