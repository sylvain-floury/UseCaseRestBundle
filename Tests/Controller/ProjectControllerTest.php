<?php

namespace Flosy\Bundle\UseCaseRestBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Flosy\Bundle\UseCaseRestBundle\Tests\Fixtures\Entity\LoadProjectData;

class ProjectControllerTest extends WebTestCase
{
    public function testJsonPostProjectAction()
    {
        $this->client = static::createClient();
        $this->client->request(
            'POST', 
            '/api/v1/projects.json',  
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"name":"My JSON Project","Description":"Description of my JSON project."}'
        );
        $this->assertJsonResponse($this->client->getResponse(), 201, false);
    }
    
    public function testJsonPostProjectActionShouldReturn400WithBadParameters()
    {
        $this->client = static::createClient();
        $this->client->request(
            'POST',
            '/api/v1/projects.json',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"foo":"bar"}'
        );

        $this->assertJsonResponse($this->client->getResponse(), 400, false);
    }
    
    public function testJsonPutProjectActionShouldModify()
    {
        $fixtures = array('Flosy\Bundle\UseCaseRestBundle\Tests\Fixtures\Entity\LoadProjectData');
        $this->customSetUp($fixtures);
        $projects = LoadProjectData::$projects;
        $project = array_pop($projects);

        $this->client->request('GET', sprintf('/api/v1/projects/%d.json', $project->getId()), array('ACCEPT' => 'application/json'));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), $this->client->getResponse()->getContent());

        $this->client->request(
            'PUT',
            sprintf('/api/v1/projects/%d.json', $page->getId()),
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"name":"My Project","description":"My Project is a dummy project."}'
        );

        $this->assertJsonResponse($this->client->getResponse(), 204, false);
        $this->assertTrue(
            $this->client->getResponse()->headers->contains(
                'Location',
                sprintf('http://flosy-2.3/api/v1/projects/%d.json', $project->getId())
            ),
            $this->client->getResponse()->headers
        );
    }

    public function testJsonPutProjectActionShouldCreate()
    {
        $id = 0;
        $this->client->request('GET', sprintf('/api/v1/projects/%d.json', $id), array('ACCEPT' => 'application/json'));
        $this->assertEquals(404, $this->client->getResponse()->getStatusCode(), $this->client->getResponse()->getContent());

        $this->client->request(
            'PUT',
            sprintf('/api/v1/projects/%d.json', $id),
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"name":"My Project","description":"My Project is a dummy project."}'
        );

        $this->assertJsonResponse($this->client->getResponse(), 201, false);
    }
}