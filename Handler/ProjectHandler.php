<?php
namespace Flosy\Bundle\UseCaseRestBundle\Handler;


use Doctrine\Common\Persistence\ObjectManager;

/**
 * Description of ProjectHandler
 *
 * @author sylvain
 */
class ProjectHandler implements ProjectHandlerInterface {

    private $om;
    private $entityClass;
    private $repository;

    public function __construct(ObjectManager $om, $entityClass)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
    }

    /**
    * Get a Page.
    *
    * @param mixed $id
    *
    * @return ProjectInterface
    */
    public function get($id)
    {
        return $this->repository->find($id);
    }

}