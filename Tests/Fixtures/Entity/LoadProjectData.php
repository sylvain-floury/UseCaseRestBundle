<?php

namespace Flosy\Bundle\UseCaseRestBundle\Tests\Fixtures\Entity;

use Flosy\Bundle\UseCaseRestBundle\Entity\Project;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Load project fixtures.
 *
 * @author sylvain
 */
class LoadProjectData implements FixtureInterface {
    
     static public $projects = array();
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
        $project = new Project();
        $project->setName('My Project');
        $project->setDescription('My Project is a dummy project.');
        
        $manager->persist($project);
        $manager->flush();
        
        self::$projects[] = $project;
                
    }
}

?>
