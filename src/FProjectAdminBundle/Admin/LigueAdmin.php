<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 10/02/2017
 * Time: 17:47
 */

namespace FProjectAdminBundle\Admin;

use FProjectAdminBundle\Form\Type\ImageFormType;
use FProjectBundle\Entity\Ligue;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class LigueAdmin extends AbstractAdmin
{
    public function toString($object)
    {
        return $object instanceof Ligue
            ? $object->getNom()
            : 'Ligue';
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        /**
         * @var Ligue $object
         */
        $object = $this->getSubject();

        $formMapper
            ->add('nom')
            ->add('file', 'file', array('label' => 'form.label_file', 'required' => false));
        if($object->getLogo() != ""){
            $formMapper->add('logo', ImageFormType::class, array(
                'label' => false,
                'type_field' =>'type',
                'image_field' =>  $object->getLogo(),
                'image_prefix' => 'media/'
            ))
                ->setHelps(array('logo' => "<i>Logo actuel</i>"));
        }

        $formMapper->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('nom');;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('nom')
            ->add('logo',null, array(
                'template' => 'FProjectAdminBundle:CRUD:list_img.html.twig',
                'sortable'=>false
            ))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                )))
        ;
    }

    /**
     * @param Ligue $object
     */
    public function preUpdate($object){

        $object->lifecycleFileUpload();
        if($object->getLogo() == "")
            $object->setLogo('images/no_image.jpg');

    }

    public function prePersist($object){
        $this->preUpdate($object);
    }
}