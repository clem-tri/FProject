<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 21/02/2017
 * Time: 10:04
 */

namespace FProjectAdminBundle\Admin;


use FProjectBundle\Entity\Classement;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ClassementAdmin extends AbstractAdmin
{

    protected $datagridValues = array(
        '_sort_order' => 'ASC',
        '_sort_by'     => 'idClub.idLigue.nom'
    );

    public function createQuery($context = 'list'){
        $proxyQuery = parent::createQuery($context);

        // Default Alias is "o"

        $proxyQuery->addOrderBy('o.points', 'DESC');
        $proxyQuery->addOrderBy('o.differenceBut', 'DESC');
        $proxyQuery->addOrderBy('o.idSaison');

       ;

        if(sizeof($this->getFilterParameters()) == 4){
            $proxyQuery->andWhere(
                $proxyQuery->expr()->eq($proxyQuery->getRootAliases()[0] . '.idSaison', ':my_param')
            );
            $proxyQuery->setParameter('my_param', uniqid());
        }

        return $proxyQuery;
    }

    public function toString($object)
    {
        return $object instanceof Classement
            ? sprintf("%s - %s",$object->getIdClub(), $object->getIdSaison())
            : 'Nouveau classement';
    }

    protected function configureRoutes(RouteCollection $collection)
    {

        $collection
            ->remove('create')
            ->remove('delete');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with("Classement", array('class' => "col-md-9"))
                ->add('nbMatchJoue',IntegerType::class , array('required' => false,'label' => 'Nombre matchs joués'))
                ->add('nbVictoire',IntegerType::class , array('required' => false,'label' => 'Nombre victoires'))
                ->add('nbNul',IntegerType::class , array('required' => false,'label' => 'Nombre matchs nuls'))
                ->add('nbDefaite',IntegerType::class , array('required' => false,'label' => 'Nombre défaites'))
                ->add('butPour',IntegerType::class , array('required' => false,'label' => 'Nombre buts pour'))
                ->add('butContre',IntegerType::class , array('required' => false,'label' => 'Nombre buts contre'))
                ->add('differenceBut',IntegerType::class , array('required' => false,'label' => 'Différence de buts'))
            ->end()
            ->with('Club', array('class' =>'col-md-3'))
                ->add('idClub', 'sonata_type_model',  array(
                    'class' => 'FProjectBundle\Entity\Club',
                    'property' => 'nom',
                    'label' => 'form.label_club'))
            ->end()
            ->with('Saison', array('class' =>'col-md-3'))
                ->add('idSaison', 'sonata_type_model',  array(
                    'class' => 'FProjectBundle\Entity\Saison',
                    'property' => 'libelle',
                    'label' => 'form.label_saison'))
            ->end();


    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        if(sizeof($this->getFilterParameters()) > 4){
            $datagridMapper
                ->add('nbMatchJoue')
                ->add('nbVictoire')
                ->add('nbNul')
                ->add('nbDefaite')
                ->add('butPour')
                ->add('butContre')
                ->add('differenceBut');
        }
            $datagridMapper
            ->add('idClub', null, array('label' => 'Club'))
            ->add('idClub.idLigue', null, array('label' => 'Ligue'))
            ->add('idSaison', null, array('label' => 'Saison'));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('idLigue.nom', null, array('label' => 'Ligue'))
            ->add('idSaison.libelle', null, array('label' => 'Saison'))
            ->add('idClub.nom', null, array('label' => 'Club'))
            ->add('points', null, array('row_align' => 'center'))
            ->add('nbMatchJoue', null, array('label' => 'MJ','row_align' => 'center'))
            ->add('nbVictoire', null, array('label' => 'V','row_align' => 'center'))
            ->add('nbNul', null, array('label' => 'N', 'row_align' => 'center'))
            ->add('nbDefaite', null, array('label' => 'D','row_align' => 'center'))
            ->add('butPour', null, array('label' => 'BP','row_align' => 'center'))
            ->add('butContre', null, array('label' => "BC",'row_align' => 'center'))
            ->add('differenceBut', null, array('label' => 'Diff','row_align' => 'center'))

        ;
    }
}