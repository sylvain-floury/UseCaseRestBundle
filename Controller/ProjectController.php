<?php

namespace Flosy\Bundle\UseCaseRestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ProjectController extends FOSRestController
{
    public function getProjectAction($id)
    {
        return $this->container->get('doctrine.entity_manager')->getRepository('Project')->find($id);
    }
}
