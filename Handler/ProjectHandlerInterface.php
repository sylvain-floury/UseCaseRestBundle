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
}
