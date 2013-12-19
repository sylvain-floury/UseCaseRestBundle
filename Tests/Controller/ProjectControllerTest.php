<?php

namespace Flosy\Bundle\UseCaseRestBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

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
