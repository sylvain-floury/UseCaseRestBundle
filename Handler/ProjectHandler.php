<?php
namespace Flosy\Bundle\UseCaseRestBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Form\FormFactoryInterface;

use Flosy\Bundle\UseCaseRestBundle\Model\ProjectInterface;
use Flosy\Bundle\UseCaseRestBundle\Form\ProjectType;
use Flosy\Bundle\UseCaseRestBundle\Exception\InvalidFormException;

/**
 * Description of ProjectHandler
 *
 * @author sylvain
 */
class ProjectHandler implements ProjectHandlerInterface {

    private $om;
    private $entityClass;
    private $repository;

    public function __construct(ObjectManager $om, $entityClass, FormFactoryInterface $formFactory)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
        $this->formFactory = $formFactory;
    }

    /**
    * Get a Project.
    *
    * @param mixed $id
    *
    * @return ProjectInterface
    */
    public function get($id)
    {
        return $this->repository->find($id);
    }
    
   /**
    * Create a new Project.
    *
    * @param array $parameters
    *
    * @return ProjectInterface
    */
   public function post(array $parameters)
   {
       $project = $this->createProject(); // factory method create an empty Project

       return $this->processForm($project, $parameters, 'POST');
   }

   /**
    * Processes the form.
    *
    * @param ProjectInterface $project
    * @param array         $parameters
    * @param String        $method
    *
    * @return ProjectInterface
    *
    * @throws \Acme\BlogBundle\Exception\InvalidFormException
    */
   private function processForm(ProjectInterface $project, array $parameters, $method = "PUT")
   {
       $form = $this->formFactory->create(new ProjectType(), $project, array('method' => $method));
       $form->submit($parameters, 'PATCH' !== $method);
       if ($form->isValid()) {

           $project = $form->getData();
           $this->om->persist($project);
           $this->om->flush($project);

           return $project;
       }

       throw new InvalidFormException('Invalid submitted data', $form);
   }
   
   private function createProject()
   {
        return new $this->entityClass();
   }
}