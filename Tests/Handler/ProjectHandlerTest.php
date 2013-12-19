<?php
namespace Flosy\Bundle\UseCaseRestBundle\Tests\Entity;

use Liip\FunctionalTestBundle\Test\WebTestCase;

use Flosy\Bundle\UseCaseBundle\Entity\Project;

use Flosy\Bundle\UseCaseRestBundle\Tests\Fixtures\Entity\LoadProjectData;

/**
 * Test ProjectHandler.
 *
 * @author sylvain
 */
class ProjectHandlerTest extends WebTestCase 
{
    /**
     * @var \Flosy\Bundle\UseCaseRestBundle\Handler\ProjectHandler
     */
    private $projectHandler;

    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->projectHandler = static::$kernel->getContainer()->get('flosy.usecase_rest.project.handler');
    }
    
    public function testGet()
    {
        $fixtures = array('Flosy\Bundle\UseCaseRestBundle\Tests\Fixtures\Entity\LoadProjectData');
        $this->client = static::createClient();
        $this->loadFixtures($fixtures);
        $projects = LoadProjectData::$projects;
        $project = array_pop($projects);

        
        $entity = $this->projectHandler->get($project->getId());
    }
    
    public function testPost()
    {
        $name = 'My handler project';
        $description = 'my handler project description.';

        $parameters = array('name' => $name, 'description' => $description);

        $project = new Project();
        $project->setName($name);
        $project->setDescription($description);

        $projectObject = $this->projectHandler->post($parameters);

        //$this->assertEquals($projectObject, $project);
    }
}

?>
