<?php

namespace Flosy\Bundle\UseCaseRestBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Flosy\Bundle\UseCaseRestBundle\Model\ProjectInterface;
use Flosy\Bundle\UseCaseRestBundle\Exception\InvalidFormException;
use Flosy\Bundle\UseCaseRestBundle\Form\ProjectType;

class ProjectController extends FOSRestController
{
   /**
    * Get single Project,
    *
    * @ApiDoc(
    * resource = true,
    * description = "Gets a Project for a given id",
    * output = "Flosy\Bundle\UseCaseRestBundle\Entity\Project",
    * statusCodes = {
    * 200 = "Returned when successful",
    * 404 = "Returned when the project is not found"
    * }
    * )
    *
    * @Annotations\View(templateVar="project")
    *
    * @param int $id the project id
    *
    * @return array
    *
    * @throws NotFoundHttpException when project not exist
    */
    public function getProjectAction($id)
    {
        $project = $this->getOr404($id);
         
        return $project;
    }
    
   /**
    * Create a Project from the submitted data.
    *
    * @ApiDoc(
    *   resource = true,
    *   description = "Creates a new project from the submitted data.",
    *   input = "Flosy\Bundle\UseCaseRestBundle\Entity\Project",
    *   statusCodes = {
    *     200 = "Returned when successful",
    *     400 = "Returned when the form has errors"
    *   }
    * )
    *
    * @Annotations\View(
    *  template = "FlosyUseCaseRestBundle:Project:editProject.html.twig",
    *  statusCode = Codes::HTTP_BAD_REQUEST,
    *  templateVar = "form"
    * )
    *
    * @param Request $request the request object
    *
    * @return FormTypeInterface|View
    */
   public function postProjectAction(Request $request)
   {
      try {
          $newProject = $this->container->get('flosy.usecase_rest.project.handler')->post(
              $request->request->all()
          );

          $routeOptions = array(
              'id' => $newProject->getId(),
              '_format' => $request->get('_format')
          );

          return $this->routeRedirectView('api_1_get_project', $routeOptions, Codes::HTTP_CREATED);
      } catch (InvalidFormException $exception) {

          return $exception->getForm();
      }
   }
   
   /**
    * Update existing project from the submitted data or create a new project at a specific location.
    *
    * @ApiDoc(
    *   resource = true,
    *   input = "Flosy\Bundle\UseCaseRestBundle\Form\ProjectType",
    *   statusCodes = {
    *     201 = "Returned when the Project is created",
    *     204 = "Returned when successful",
    *     400 = "Returned when the form has errors"
    *   }
    * )
    *
    * @Annotations\View(
    *  template = "FlosyUseCaseRestBundle:Project:editProject.html.twig",
    *  templateVar = "form"
    * )
    *
    * @param Request $request the request object
    * @param int     $id      the project id
    *
    * @return FormTypeInterface|View
    *
    * @throws NotFoundHttpException when project not exist
    */
   public function putProjectAction(Request $request, $id)
   {
       try {
           if (!($project = $this->container->get('flosy.usecase_rest.project.handler')->get($id))) {
               $statusCode = Codes::HTTP_CREATED;
               $project = $this->container->get('flosy.usecase_rest.project.handler')->post(
                   $request->request->all()
               );
           } else {
               $statusCode = Codes::HTTP_NO_CONTENT;
               $project = $this->container->get('flosy.usecase_rest.project.handler')->put(
                   $project,
                   $request->request->all()
               );
           }

           $routeOptions = array(
               'id' => $project->getId(),
               '_format' => $request->get('_format')
           );

           return $this->routeRedirectView('api_1_get_project', $routeOptions, $statusCode);

       } catch (InvalidFormException $exception) {

           return $exception->getForm();
       }
   }
   
   /**
    * Presents the form to use to create a new project.
    *
    * @ApiDoc(
    *   resource = true,
    *   statusCodes = {
    *     200 = "Returned when successful"
    *   }
    * )
    *
    * @Annotations\View()
    *
    * @return FormTypeInterface
    */
   public function newProjectAction()
   {
       return $this->createForm(new ProjectType());
   }
   
   /**
    * Presents the form to use to edit a new project.
    *
    * @ApiDoc(
    *   resource = true,
    *   statusCodes = {
    *     200 = "Returned when successful"
    *   }
    * )
    *
    * @Annotations\View()
    *
    * @return FormTypeInterface
    * 
    * @throws NotFoundHttpException
    */
   public function editProjectAction($id)
   {
       $project = $this->getOr404($id);
       
       return $this->createForm(new ProjectType(), $project );
   }
   
   /**
    * List all projects.
    *
    * @ApiDoc(
    *   resource = true,
    *   statusCodes = {
    *     200 = "Returned when successful"
    *   }
    * )
    *
    * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing projects.")
    * @Annotations\QueryParam(name="limit", requirements="\d+", default="5", description="How many projects to return.")
    *
    * @Annotations\View(
    *  templateVar="projects"
    * )
    *
    * @param Request               $request      the request object
    * @param ParamFetcherInterface $paramFetcher param fetcher service
    *
    * @return array
    */
   public function getProjectsAction(Request $request, ParamFetcherInterface $paramFetcher)
   {
       $offset = $paramFetcher->get('offset');
       $offset = null == $offset ? 0 : $offset;
       $limit = $paramFetcher->get('limit');

       return $this->container->get('flosy.usecase_rest.project.handler')->all($limit, $offset);
   }
    
   /**
    * Fetch a Project or throw an 404 Exception.
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
