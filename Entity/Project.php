<?php

namespace Flosy\Bundle\UseCaseRestBundle\Entity;

use Flosy\Bundle\UseCaseRestBundle\Model\ProjectInterface;

use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Flosy\Bundle\UseCaseBundle\Entity\Project
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Project implements ProjectInterface
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Length(
     *      min = "2",
     *      minMessage = "Your project name must be at least {{ limit }} characters."
     * )
     */
    private $name;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="UseCase", mappedBy="project", cascade={"all"})
     */
    private $useCases;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(name="updated", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updated;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Project
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Project
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    public function getCreated()
    {
        return $this->created;
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Project
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Project
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    
        return $this;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->useCases = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add useCases
     *
     * @param \Flosy\Bundle\UseCaseBundle\Entity\UseCase $useCases
     * @return Project
     */
    public function addUseCase(\Flosy\Bundle\UseCaseBundle\Entity\UseCase $useCases)
    {
        $this->useCases[] = $useCases;

        return $this;
    }

    /**
     * Remove useCases
     *
     * @param \Flosy\Bundle\UseCaseBundle\Entity\UseCase $useCases
     */
    public function removeUseCase(\Flosy\Bundle\UseCaseBundle\Entity\UseCase $useCases)
    {
        $this->useCases->removeElement($useCases);
    }

    /**
     * Get useCases
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUseCases()
    {
        return $this->useCases;
    }
    
    public function __toString() {
        return $this->name;
    }
}
