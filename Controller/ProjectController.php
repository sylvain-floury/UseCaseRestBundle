<?php

namespace Flosy\Bundle\UseCaseRestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ProjectController extends FOSRestController
{
   /**
    * Get single Page,
    *
    * #ApiDoc(
    * resource = true,
    * description = "Gets a Page for a given id",
    * output = "Acme\BlogBundle\Entity\Page",
    * statusCodes = {
    * 200 = "Returned when successful",
    * 404 = "Returned when the page is not found"
    * }
    * )
    *
    * @Annotations\View(templateVar="project")
    *
    * @param int $id the page id
    *
    * @return array
    *
    * @throws NotFoundHttpException when page not exist
    */
    public function getProjectAction($id)
    {
        $project = $this->container
        ->get('flosy.usecase_rest.project.handler')
        ->get($id);
         
        return $project;
    }
}
