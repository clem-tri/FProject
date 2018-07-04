<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 13/06/2017
 * Time: 13:51
 */

namespace FProjectBundle\Twig;


class DaysToYearsExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('to_years', array($this, 'to_years')),
        );
    }
    public function to_years($days)
    {
        $days = (int) $days;
        $years = intval($days / 365);

        return $years;
    }
    public function getName()
    {
        return 'to_years_extension';
    }
}