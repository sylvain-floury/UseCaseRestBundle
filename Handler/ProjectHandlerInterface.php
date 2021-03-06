<?php
namespace Flosy\Bundle\UseCaseRestBundle\Handler;

use Flosy\Bundle\UseCaseRestBundle\Model\ProjectInterface;

/**
 *
 * @author sylvain
 */
interface ProjectHandlerInterface {
   /**
    * Get a Project given the identifier
    *
    * @api
    *
    * @param int $id
    *
    * @return ProjectInterface
    */
    public function get($id);
    
   /**
    * Post Project, creates a new Project.
    *
    * @param array $parameters
    *
    * @return ProjectInterface
    */
    public function post(array $parameters);
    
   /**
    * Edit a Project, or create if not exist.
    *
    * @param ProjectInterface $project
    * @param array         $parameters
    *
    * @return ProjectInterface
    */
   public function put(ProjectInterface $project, array $parameters);

   /**
    * Partially update a Project.
    *
    * @param ProjectInterface $project
    * @param array         $parameters
    *
    * @return ProjectInterface
    */
   public function patch(ProjectInterface $project, array $parameters);
   
   /** 
    * Get a list of Projects.
    *
    * @param int $limit  the limit of the result
    * @param int $offset starting from the offset
    *
    * @return array
    */
   public function all($limit = 5, $offset = 0, $orderby = null);
}
