<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 05/06/2017
 * Time: 17:36
 */

namespace FProjectBundle\Twig;

use Symfony\Component\Intl\Intl;

class CountryExtension extends \Twig_Extension
{
    public function getFilters(){
        return array(
            new \Twig_SimpleFilter('countryName', array($this, 'countryName'))
        );
    }

    public function countryName($countryCode){
        return Intl::getRegionBundle()->getCountryName($countryCode);
    }


    public function getName(){
        return 'country_extension';
    }

}