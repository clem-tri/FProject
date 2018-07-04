<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 09/02/2017
 * Time: 10:08
 */

namespace FProjectAdminBundle\Admin;


use FProjectBundle\Entity\Club;
use FProjectAdminBundle\Form\Type\ImageFormType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class ClubAdmin extends AbstractAdmin
{
    public function toString($object)
    {
        return $object instanceof Club
            ? $object->getNom()
            : 'Club';
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        /**
         * @var Club $object
         */
        $object = $this->getSubject();
        $now = new \DateTime();

        $formMapper->add('nom')
            ->add('dateCreation', 'sonata_type_date_picker')
            ->add('idLigue','sonata_type_model', array(
                        'class' => 'FProjectBundle\Entity\Ligue',
                        'property' => 'nom',
                        'label' => 'Ligue'))
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
        $datagridMapper->add('nom')
            ->add('dateCreation');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->add('nom')
            ->add('dateCreation')
            ->add('logo',null, array(
                'template' => 'FProjectAdminBundle:CRUD:list_img.html.twig',
                'sortable'=>false
            ))
            ->addIdentifier('idLigue.nom', null , array('label' => 'Ligue'))
        ->add('_action', 'actions', array(
            'actions' => array(
            'edit' => array(),
            'delete' => array()
            )
        ));
    }

    /**
     * @param Club $object
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