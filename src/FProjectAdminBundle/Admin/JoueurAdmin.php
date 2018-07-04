<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 08/02/2017
 * Time: 18:19
 */

namespace FProjectAdminBundle\Admin;


use FProjectBundle\Entity\Joueur;
use FProjectAdminBundle\Form\Type\ImageFormType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

class JoueurAdmin extends AbstractAdmin
{
    protected $frontRouteName = 'fproject_joueur_joueur';

    public function getFrontRouteName()
    {
        return $this->frontRouteName;
    }

    public function toString($object)
    {
        return $object instanceof Joueur
            ? sprintf("%s %s",$object->getPrenom(), $object->getNom())
            : 'Joueur';
    }


    protected $datagridValues = array(
        'sort_by' => 'nom',
        'sort_order' => 'ASC'
    );



    protected function configureFormFields(FormMapper $formMapper)
    {
        /** @var Joueur $object */
        $object = $this->getSubject();

        $formMapper
            ->with('Joueur', array('class' => 'col-md-9'))
                ->add('nom' ,'text',array('label' => 'form.label_nom'))
                ->add('prenom', 'text',array('label' => 'form.label_prenom', 'required' => false) )
                ->add('dateNaissance', BirthdayType::class,
                    array(
                        'empty_value' => '',
                        'required' => false
                    ))
                ->add('nationalite', CountryType::class,array('required' => false))
                ->add('file', 'file', array('label' => 'form.label_file', 'required' => false))
                ->add('numMaillot', null, array('label' => 'N° maillot'))
                ->add('taille');
        if($object->getPhoto() != ""){
            $formMapper->add('photo', ImageFormType::class, array(
                'label' => false,
                'type_field' =>'type',
                'image_field' =>  $object->getPhoto(),
                'image_prefix' => 'media/'
            ))
                ->setHelps(array('photo' => "<i>Photo actuelle</i>"));
        }

            $formMapper->end()
            ->with('Club', array('class' =>'col-md-3'))
                ->add('idClub', 'sonata_type_model',  array(
                        'class' => 'FProjectBundle\Entity\Club',
                        'property' => 'nom',
                        'empty_value' => '',
                        'required' => false,
                        'label' => 'form.label_club'))
            ->end()
            ->with('Poste', array('class' =>'col-md-3'))
                ->add('idPoste','sonata_type_model', array(
                        'class' => 'FProjectBundle\Entity\Poste',
                        'label' => 'form.label_poste'))
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('nom')
        ->add('prenom')
        ->add('idClub', null, array('label' => 'Club'))
        ->add('idPoste', null, array('label' => 'Poste'));

    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->add('nom')
        ->add('prenom')
        ->add('photo' ,null, array(
        'template' => 'FProjectAdminBundle:CRUD:list_img.html.twig',
        'sortable'=>false
    ))

        ->addIdentifier('idClub.nom', null , array('label' => 'Club'))
        ->addIdentifier('idPoste.libelle', null , array('label' => 'Poste'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'front_view' => array( 'template' => 'FProjectAdminBundle:CRUD:list__action_front_view.html.twig'),
                    'delete' => array(),

                )));
    }

    /** @var Joueur $joueur  */
    public function preUpdate($joueur){

        $joueur->lifecycleFileUpload();
        if($joueur->getPhoto() == "")
            $joueur->setPhoto('images/no_image.jpg');
    }

    public function prePersist($object){
        $this->preUpdate($object);
    }


}