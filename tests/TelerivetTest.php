<?php

use PHPUnit\Framework\TestCase;
use Napoleon\Telerivet\Telerivet;
use Napoleon\Telerivet\Hooks\SendTextMessage;

class TelerivetTest extends TestCase
{
    /** @test */
    public function it_contest_the_functionality_of_the_class()
    {
        $env = [
            'base_url'   => 'https://api.telerivet.com/v1/projects',
            'project_id' => 'FAKE_PROJECT_ID',
            'api_key'    => 'FAKE_API_KEY',
        ];

        $telerivet = new Telerivet(new SendTextMessage, $env);
        $condition = [
            $env['base_url'],
            $env['project_id'],
            $telerivet->getEndPoint(),
        ];

        $this->assertEquals($telerivet->getRequestUrl(), implode('/', $condition));
    }

    /** @test */
    public function other_way_of_setting_environment()
    {
        $env = [
            'base_url'   => 'https://api.telerivet.com/v1/projects',
            'project_id' => 'FAKE_PROJECT_ID',
            'api_key'    => 'FAKE_API_KEY',
        ];

        $telerivet = new Telerivet(new SendTextMessage);
        $telerivet->setEnv($env);
        $condition = [
            $env['base_url'],
            $env['project_id'],
            $telerivet->getEndPoint(),
        ];

        $this->assertEquals($telerivet->getRequestUrl(), implode('/', $condition));
    }

    /** @test */
    public function it_should_prioritise_settings_on_hook_class()
    {
        $env = [
            'base_url'   => 'https://api.telerivet.com/v1/projects',
            'project_id' => 'FAKE_PROJECT_ID',
            'api_key'    => 'FAKE_API_KEY',
        ];

        $sendTextMessage = (new SendTextMessage)->setEnv($env);
        $telerivet = new Telerivet($sendTextMessage);

        $condition = [
            $env['base_url'],
            $env['project_id'],
            $telerivet->getEndPoint(),
        ];

        $this->assertEquals($telerivet->getRequestUrl(), implode('/', $condition));
    }
}
