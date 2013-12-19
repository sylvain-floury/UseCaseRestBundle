<?php

namespace Flosy\Bundle\UseCaseRestBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Flosy\Bundle\UseCaseRestBundle\Model\ProjectInterface;

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
        $project = $this->getOr404($id);
         
        return $project;
    }
    
   /**
    * Fetch a Page or throw an 404 Exception.
    *
    * @param int $id
    *
    * @return ProjectInterface
    *
    * @throws NotFoundHttpException
    */
    protected function getOr404($id)
    {
        if (!($project = $this->container->get('flosy.usecase_rest.project.handler')->get($id))) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.',$id));
        }

        return $project;
    }
}
