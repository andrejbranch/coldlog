<?php

namespace ColdLog\Bundle\MainBundle\Controller\Home;

use ColdLog\Bundle\MainBundle\Controller\ColdLogController;

class HomeController extends ColdLogController
{
    public function homeAction($test = null)
    {
        return $this->render('MainBundle:Home:home.html.twig');
    }
}