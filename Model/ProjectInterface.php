<?php

namespace Flosy\Bundle\UseCaseRestBundle\Model;


/**
 * Flosy\Bundle\UseCaseBundle\Model\ProjectInterface
 *
 */
interface ProjectInterface
{
    
    /**
     * Set name
     *
     * @param string $name
     * @return ProjectInterface
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string 
     */
    public function getName();
    
    /**
     * Set description
     *
     * @param string $description
     * @return ProjectInterface
     */
    public function setDescription($description);
    

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription();
    
    
    public function getCreated();
    

    public function getUpdated();
    
    /**
     * Set created
     *
     * @param \DateTime $created
     * @return ProjectInterface
     */
    public function setCreated($created);
    

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return ProjectInterface
     */
    public function setUpdated($updated);
    
    
    /**
     * Add useCases
     *
     * @param \Flosy\Bundle\UseCaseBundle\Entity\UseCase $useCases
     * @return Project
     */
    //public function addUseCase(\Flosy\Bundle\UseCaseBundle\Model\UseCaseInterface $useCases);
    

    /**
     * Remove useCases
     *
     * @param \Flosy\Bundle\UseCaseBundle\Entity\UseCase $useCases
     */
    //public function removeUseCase(\Flosy\Bundle\UseCaseBundle\Model\UseCaseInterface $useCases);
    
    /**
     * Get useCases
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    //public function getUseCases();
    
}
