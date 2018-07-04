<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 15/02/2017
 * Time: 11:27
 */

namespace FProjectAdminBundle\Admin;



use Sonata\AdminBundle\Form\Type\Filter\NumberType;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Form\Type\BooleanType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Doctrine\ORM\EntityManager;
use FProjectBundle\Entity\Classement;
use FProjectBundle\Entity\Club;
use FProjectBundle\Entity\Confrontation;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Validator\ErrorElement;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\HttpKernel\EventListener\ValidateRequestListener;

class ConfrontationAdmin extends AbstractAdmin
{

    protected $frontRouteName = 'fproject_confrontation_game';

    public function getFrontRouteName()
    {
        return $this->frontRouteName;
    }

    public function createQuery($context = 'list')
    {
        $proxyQuery = parent::createQuery('list');
        // Default Alias is "o"
        $proxyQuery->addOrderBy('o.date', 'DESC');
        $proxyQuery->addOrderBy('o.idSaison', 'ASC');

        return $proxyQuery;
    }

    public function getNewInstance(){
        /** @var Confrontation $instance */
        $instance = parent::getNewInstance();
//        $instance->setIdClubExt();

        return $instance;
    }



    public function toString($object){
        return $object instanceof Confrontation
            ? sprintf("%s vs %s",$object->getIdClubDom(), $object->getIdClubExt())
            : 'Confrontation';
    }

    public function configureFormFields(FormMapper $formMapper){

        // query Companies
        /** @var EntityManager $em */
        $em = $this->getModelManager()->getEntityManager('FProjectBundle:Club');
        $confrontationQb = $em->createQueryBuilder();

        $confrontationQb->select('c')->from('FProjectBundle:Club', 'c')
            ->orderBy('c.idLigue')
            ->addOrderBy('c.nom');


        $formMapper
            ->tab('Général')
                ->with('Equipes', array('class' =>'col-md-6'))
                    ->add('idClubDom', 'sonata_type_model',  array(
                            'class' => 'FProjectBundle\Entity\Club',
                            'property' => 'nom',
                            'group_by' => function($val, $key, $index) {
                                /** @var EntityManager $emClub */
                                $emClub = $this->getModelManager()->getEntityManager('FProjectBundle:Club');
                                $repoClub = $emClub->getRepository('FProjectBundle:Club');
                                $club =  $repoClub->findOneBy(array(
                                    'id' => $val,
                                ));

                                return $club->getIdLigue();
                            },
                            'query' => $confrontationQb->getQuery(),
                            'label' => 'Equipe à domicile'))
                    ->add('idClubExt', 'sonata_type_model',  array(
                            'class' => 'FProjectBundle\Entity\Club',
                            'property' => 'nom',
                            'group_by' => function($val, $key, $index) {
                            /** @var EntityManager $emClub */
                                $emClub = $this->getModelManager()->getEntityManager('FProjectBundle:Club');
                                $repoClub = $emClub->getRepository('FProjectBundle:Club');
                                $club =  $repoClub->findOneBy(array(
                                    'id' => $val,
                                ));

                                return $club->getIdLigue();
                        },
                            'query' => $confrontationQb->getQuery(),
                            'label' => 'Equipe à l\'extérieur'))
            ->end()
                ->with('Infos', array('class' => 'col-md-3'))
                    ->add('date', 'sonata_type_datetime_picker')
                    ->add('idSaison', 'sonata_type_model',  array(
                        'class' => 'FProjectBundle\Entity\Saison',
                        'property' => 'libelle',
                        'label' => 'form.label_saison'))

            ->add('idPhaseFinale',  'sonata_type_model',  array(
                'class' => 'FProjectBundle\Entity\PhaseFinale',
                'property' => 'libelle',
                'required' => false,
                'label' => 'form.label_phaseFinale',
                'help' => '<i class="glyphicon glyphicon-exclamation-sign"></i> Si match à élimination directe'))
                ->end()
                ->with('Compétition', array('class' => 'col-md-3'))
                    ->add('idLigue', 'sonata_type_model', array(
                            'class' => 'FProjectBundle\Entity\Ligue',
                            'property' => 'nom',
                            'label' => 'Ligue'))
                ->end()


               /* ->with('Score', array('class' =>'col-md-3'))
                    ->add('scoreClubDom',IntegerType::class ,array('attr' => array('min' => 0), 'required' => false))
                    ->add('scoreClubExt',IntegerType::class ,array('attr' => array('min' => 0), 'required' => false))

                ->end()*/

            ->end()

            ->tab('Buts')
                ->with('Buts')
                    ->add('Buts', 'sonata_type_collection',
                    array(
                       'label' => false,
                        'by_reference' => false
                    ),
                    array(
                        'inline' => 'table',
                        'edit' => 'inline',
                        'allow_delete' => true,
                        'allow_add'    => true,

                        'admin_code'   => 'admin.but'
                    )
                )
            ->end()
            ->end()
                    ->tab('Compositions')
                        ->with('Compositions')
                            ->add('Compositions', 'sonata_type_collection',
                array(
                    'label' => false,
                    'by_reference' => false
                ),
                array(
                    'edit' => 'inline',
                    'allow_delete' => true,
                    'allow_add'    => true,
                    'limit' => 2,
                    'admin_code'   => 'admin.composition'
                )
            )
            ->end()
            ->end()
            ->tab('Statistiques générales')
                    ->with('Statistiques générales')

                        ->add('possessionDom',PercentType::class ,
                            array(
                            'scale' => 2,
                            'type'=>'integer',
                            'label' => 'Possession de l\'équipe domicile',
                            'attr' => array('min' => 0,
                                'max' => 100,
                                ),
                            'required' => false))
                            ->add('possessionExt',
                                PercentType::class ,
                                array(
                                    'scale' => 2,
                                    'type'=>'integer',
                                    'label' => 'Possession de l\'équipe éxtérieur',
                                    'attr' => array(
                                        'min' => 0,
                                        'max' => 100,
                                        ),
                                    'required' => false))
            ->end()
           ;
        ;

    }

    public function configureShowFields(ShowMapper $showMapper){
        $showMapper->add('Buts');

    }


    public function configureListFields(ListMapper $listMapper){

        $listMapper->add('idLigue', null, array('label' => 'Ligue',   'header_style' => 'min-width:200px;'))
                    ->add('idClubDom.nom', null, array('label' => 'Club Domicile'))
                    ->add('idClubExt.nom', null, array('label' => 'Club Extérieur'))
                    ->add('scoreClubDom', null, array('label' => 'Nombre buts éq. domicile'))
                    ->add('scoreClubExt', null, array('label' => 'Nombre buts éq. extérieur'))
                    ->add('date', 'date', array("editable" => true))
                    ->add('_action', 'actions', array(
                                'header_style' => 'min-width:300px;',
                                'actions' => array(
                                'edit' => array(),
                                'front_view' => array( 'template' => 'FProjectAdminBundle:CRUD:list__action_front_view.html.twig'),
                                'delete' => array()
                                )
                        )
                    );
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('idLigue')
            ->add('idClubDom', null, array('label' => 'Club domicile'))
            ->add('idClubExt', null, array('label' => 'Club extérieur'))
            ->add('scoreClubDom', null, array('label' => 'Score Club domicile'))
            ->add('scoreClubExt', null, array('label' => 'Score Club extérieur'))
            ->add('date');
    }


    /**
     * @param ErrorElement $errorElement
     * @param Confrontation $object
     */
    public function validate(ErrorElement $errorElement, $object)
    {
        if($object->getIdClubDom() === $object->getIdClubExt())
        $errorElement->with('idClubDom')->addViolation('Les clubs ne peuvent pas être identiques')->end()
        ->with('idClubExt')->addViolation('Les clubs ne peuvent pas être identiques')->end();

        if(!$object->getButs()->isEmpty()){
            foreach ($object->getButs() as $but){
                if($but->getIdClub() !== $object->getIdClubDom() && $but->getIdClub() !== $object->getIdClubExt())
                {
                    $errorElement
                        ->addViolation('Buts : Un des clubs renseigné ne correspond pas aux équipes de la Confrontation')
                        ->end();
                }

                if($but->getCsc() == 1 && $but->getPenalty() == 1)
                    $errorElement->addViolation('Buts : Le but ne peut être un Penalty ET un Csc');
            }
        }

        if(!$object->getCompositions()->isEmpty()){

            foreach ($object->getCompositions() as $composition){

                if($composition->getIdClub() !== $object->getIdClubDom() && $composition->getIdClub() !== $object->getIdClubExt()){

                    $errorElement
                        ->addViolation('Compositions : Un des deux clubs renseigné ne correspond pas aux équipes de la Confrontation')
                        ->end();
                }
            }
        }

        if($object->getPossessionDom() != null && $object->getPossessionExt() != null){

            if($object->getPossessionDom() + $object->getPossessionExt() != 100)
                $errorElement
                    ->with('possessionDom')
                    ->addViolation('La somme des deux possessions doit être égal à 100')
                    ->end()
                    ->with('possessionExt')
                    ->addViolation('La somme des deux possessions doit être égal à 100')
                    ->end();
        }
    }

    /** @param Confrontation $object  */
    public function prePersist($object){
        $this->preUpdate($object);
    }

    public function postUpdate($object){
        $this->updateClassement($object);
    }

    /** @param Confrontation $object  */
    public function postPersist($object){
        $this->updateClassement($object);
    }

    /** @param Confrontation $object  */
    public function postRemove($object){
        $this->updateClassement($object);
    }

    /** @param Confrontation $object  */
    public function preUpdate($object){

        $this->refreshScore($object);
        $this->updateClassement($object);


    }

    public function refreshScore($object){
        /**
         * @var Confrontation $object
         */
        if(!$object->getButs()->isEmpty()){

            $object->setScoreClubDom(0);
            $object->setScoreClubExt(0);

            foreach ($object->getButs() as $but){
                if(($but->getIdClub() === $object->getIdClubDom() && $but->getCsc())
                    ||
                    ($but->getIdClub() === $object->getIdClubExt() && $but->getCsc() == null))
                    $object->setScoreClubExt($object->getScoreClubExt()+1);
                else
                    $object->setScoreClubDom($object->getScoreClubDom()+1);

            }
        }
    }

    public function updateClassement($object){
        /**
         * @var Confrontation $object
         */

        if(!$object->getIdPhaseFinale()){

            foreach ((array)$object as $item){
                if($item instanceof Club){
                    /** @var EntityManager $emClassement */
                    $emClassement = $this->getModelManager()->getEntityManager('FProjectBundle:Classement');
                    $repoClassement = $emClassement->getRepository('FProjectBundle:Classement');
                    /** @var EntityManager $emConfrontation */
                    $emConfrontation = $this->getModelManager()->getEntityManager('FProjectBundle:Confrontation');
                    $repoConfrontation = $emConfrontation->getRepository('FProjectBundle:Confrontation');

                    $classement=  $repoClassement->findOneBy(array(
                        'idClub' => $item,
                        'idSaison' => $object->getIdSaison(),
                    ));


                    $repoConfrontation = $repoConfrontation->createQueryBuilder('c');
                    //comptage nombre de matchs
                    $countConfrontations = $repoConfrontation->select($repoConfrontation->expr()->count('c'))
                        ->where('c.idClubDom = :club')
                        ->orWhere('c.idClubExt = :club')
                        ->andWhere('c.scoreClubDom IS NOT NULL')
                        ->andWhere('c.scoreClubExt IS NOT NULL')
                        ->andWhere('c.idLigue = :ligue')
                        ->setParameter('club', $item)
                        ->setParameter('ligue', $object->getIdLigue());
                    $resultCountConf = $countConfrontations->getQuery()->getResult();
                    // count victoires
                    $countConfrontations = $countConfrontations
                        ->where('c.idClubDom = :club AND c.scoreClubDom > c.scoreClubExt')
                        ->orWhere('c.idClubExt = :club AND c.scoreClubExt > c.scoreClubDom')
                        ->andWhere('c.idLigue = :ligue')
                        ->setParameter('ligue', $object->getIdLigue());

                    $resultCountVictoire = $countConfrontations->getQuery()->getResult();

                    // count defaites
                    $countConfrontations = $countConfrontations
                        ->where('c.idClubDom = :club AND c.scoreClubDom < c.scoreClubExt')
                        ->orWhere('c.idClubExt = :club AND c.scoreClubExt < c.scoreClubDom')
                        ->andWhere('c.idLigue = :ligue')
                        ->setParameter('ligue', $object->getIdLigue());
                    $resultCountDefaites = $countConfrontations->getQuery()->getResult();

                    // count nuls
                    $countConfrontations = $countConfrontations
                        ->where('c.idClubDom = :club AND c.scoreClubDom = c.scoreClubExt')
                        ->orWhere('c.idClubExt = :club AND c.scoreClubExt = c.scoreClubDom')
                        ->andWhere('c.scoreClubDom IS NOT NULL')
                        ->andWhere('c.scoreClubExt IS NOT NULL')
                        ->andWhere('c.idLigue = :ligue')
                        ->setParameter('ligue', $object->getIdLigue());
                    $resultCountNuls = $countConfrontations->getQuery()->getResult();

                    //count buts pour domicile
                    $repoConfrontation = $emConfrontation->getRepository('FProjectBundle:Confrontation');
                    $repoConfrontation =$repoConfrontation->createQueryBuilder('c');
                    $countGoalsForDom = $repoConfrontation
                        ->select('SUM(c.scoreClubDom)')
                        ->where('c.idClubDom = :club')
                        ->andWhere('c.scoreClubDom IS NOT NULL')
                        ->setParameter('club', $item)
                        ->andWhere('c.idLigue = :ligue')
                        ->setParameter('ligue', $object->getIdLigue());
                    $resultGoalsForDom = $countGoalsForDom->getQuery()->getResult();

                    //count buts pour exterieur
                    $countGoalsForExt = $repoConfrontation->select("SUM(c.scoreClubExt)")
                        ->where('c.idClubExt = :club')
                        ->andWhere('c.scoreClubExt IS NOT NULL')
                        ->andWhere('c.idLigue = :ligue')
                        ->setParameter('ligue', $object->getIdLigue());;
                    $resultGoalsForExt = $countGoalsForExt->getQuery()->getResult();

                    //count buts contre domicile
                    $countGoalsAgainstDom =  $repoConfrontation->select("SUM(c.scoreClubExt)")
                        ->where('c.idClubDom = :club')
                        ->andWhere('c.scoreClubExt IS NOT NULL')
                        ->andWhere('c.idLigue = :ligue')
                        ->setParameter('ligue', $object->getIdLigue());;
                    $resultGoalsAgainstDom = $countGoalsAgainstDom->getQuery()->getResult();
                    // count buts oontre extérieur
                    $countGoalsAgainstExt = $repoConfrontation->select('SUM(c.scoreClubDom)')
                        ->where('c.idClubExt = :club')
                        ->andWhere('c.scoreClubDom IS NOT NULL')
                        ->andWhere('c.idLigue = :ligue')
                        ->setParameter('ligue', $object->getIdLigue());;
                    $resultGoalsAgainstExt = $countGoalsAgainstExt->getQuery()->getResult();

                    $goalsFor = $resultGoalsForDom[0][1]+$resultGoalsForExt[0][1];
                    $goalsAgainst = $resultGoalsAgainstDom[0][1]+$resultGoalsAgainstExt[0][1];

                    $stats = array(
                        $resultCountConf[0][1],
                        $resultCountVictoire[0][1],
                        $resultCountDefaites[0][1],
                        $resultCountNuls[0][1],
                        $resultGoalsForDom[0][1],
                        $resultGoalsForExt[0][1],
                        $resultGoalsAgainstDom[0][1],
                        $resultGoalsAgainstExt[0][1],
                    );

                    foreach ($stats as $stat){
                        if($stat == null)
                            $stat=0;
                    }




                    if (!$classement instanceof Classement) {

                        $classement = new Classement();
                    }

                    $classement->setIdClub($item);
                    $classement->setIdSaison($object->getIdSaison());
                    $classement->setIdLigue($object->getIdLigue());
                    $classement->setNbMatchJoue($resultCountConf[0][1]);
                    $classement->setNbVictoire($resultCountVictoire[0][1]);
                    $classement->setNbDefaite($resultCountDefaites[0][1]);
                    $classement->setNbNul($resultCountNuls[0][1]);
                    $classement->setButPour($goalsFor);
                    $classement->setButContre($goalsAgainst);
                    $classement->setDifferenceBut($classement->getButPour() - $classement->getButContre());
                    $classement->setPoints(3*$classement->getNbVictoire()+$classement->getNbNul());

                    $emClassement->persist($classement);
                    $emClassement->flush();







                }

            }
        }


    }
}