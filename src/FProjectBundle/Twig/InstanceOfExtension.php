<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 06/06/2017
 * Time: 10:47
 */

namespace FProjectBundle\Twig;


use FProjectBundle\Entity\Joueur;

class InstanceOfExtension extends \Twig_Extension
{
    public function getTests(){
        return array(
            new \Twig_SimpleTest('Joueur', function ($var) { return $var instanceof Joueur; })
        );
    }


}