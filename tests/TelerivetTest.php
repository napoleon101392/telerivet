<?php

use PHPUnit\Framework\TestCase;
use Napoleon\Telerivet\Telerivet;
use Napoleon\Telerivet\Hooks\SendTextMessage;

class TelerivetTest extends TestCase
{
    /** @test */
    public function foo()
    {
        $env = [
            'base_url'   => 'https://api.telerivet.com/v1/projects',
            'project_id' => 'PJ404b9082fe67d0f8',
            'api_key'    => 'Z3HTC_E9cxzrQpzUKEa9ZVcTMShXLdIJTOq8',
        ];

        $telerivet = new Telerivet(new SendTextMessage, $env);

        $endpoint = 'messages/send';

        $condition = [
            $env['base_url'],
            $env['project_id'],
            $endpoint,
        ];

        $this->assertEquals(
            $telerivet->getRequestUrl(),
            implode('/', $condition)
        );

        # assert headers
    }
}
