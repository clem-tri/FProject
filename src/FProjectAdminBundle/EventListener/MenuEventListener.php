<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 14/02/2017
 * Time: 15:52
 */

namespace FProjectAdminBundle\EventListener;

use Sonata\AdminBundle\Event\ConfigureMenuEvent;
class MenuEventListener
{
    public function addMenuItems(ConfigureMenuEvent $event)
    {
        $menu = $event->getMenu();

        $child = $menu->addChild('front_home', array(
            'route' => 'f_project_homepage'
        ));
        $child->setAttribute('icon', '<i class="fa fa-hand-o-right"></i>');
        $child->setLabel('Aller sur le site');
    }



}