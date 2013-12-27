<?php
namespace Flosy\Bundle\UseCaseRestBundle\Handler;

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
    * Post Page, creates a new Project.
    *
    * @param array $parameters
    *
    * @return ProjectInterface
    */
    public function post(array $parameters);
}
