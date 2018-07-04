<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 20/02/2017
 * Time: 13:42
 */

namespace FProjectBundle\Controller;


use FProjectBundle\Service\ClassementService;
use FProjectBundle\Service\LigueService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ClassementController extends Controller
{
    /**
     * @Route("/classement/{idLigue}/{saison}")
     * @Template
     */
    public function classementAction($idLigue,$saison){
        /** @var LigueService $service */
        $service = $this->get('fprojectbundle.ligue');
        $ligues = $service->get();

        /** @var ClassementService $service */
        $service = $this->get('fprojectbundle.classement');

        $classement = $service->get($idLigue,$saison);

        if($classement == null)
            throw new NotFoundHttpException(sprintf("Not found: classement for %s - %s", $idLigue, $saison));

        return array(
           'classement' => $classement,
            'ligues' => $ligues
        );

    }

}