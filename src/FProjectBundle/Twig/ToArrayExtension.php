<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 27/04/2017
 * Time: 16:36
 */

namespace FProjectBundle\Twig;


class ToArrayExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('to_array', array($this, 'to_array')),
        );
    }
    public function to_array($stdClassObject)
    {
        $array =  (array) $stdClassObject;

        return $array;
    }
    public function getName()
    {
        return 'to_array_extension';
    }

}