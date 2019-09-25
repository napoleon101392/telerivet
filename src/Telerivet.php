<?php

namespace Napoleon\Telerivet;

use Napoleon\Telerivet\Exceptions\MissingSettings;
use Napoleon\Telerivet\Contracts\TelerivateInterface;
use Napoleon\Telerivet\Exceptions\MissingConfigException;

class Telerivet
{
    protected $request;

    protected $config = [];

    public $error_bag = [];

    protected $hook;

    public function __construct(TelerivateInterface $hook, $env)
    {
        $this->hook = $hook;

        $this->setUp($env);
    }

    public function getRequestUrl()
    {
        $combination = [
            $this->getConfigUrl(),
            $this->getConfigProject(),
            $this->hook->endpoint()
        ];

        return implode('/', $combination);
    }

    public function getHeaders()
    {
        return $this->hook->headers();
    }

    public function setUp($env)
    {
        $this->validateEnv($env);

        $this->config = [
            'base_url'   => $env['base_url'],
            'project_id' => $env['project_id'],
            'api_key'    => $env['api_key'],
        ];

        return $this;
    }

    private function validateEnv($settings)
    {
        if (empty($settings)) {
            throw new MissingSettings;
        }

        $this->analyseParameter($settings)->finalize();

        return $this;
    }

    protected function analyseParameter($settings)
    {
        foreach ($settings as $key => $value) {
            if (is_null($value)) {
                array_push($error_bag, ucfirst($key));
            }
        }

        return $this;
    }

    protected function finalize()
    {
        if (!empty($this->error_bag)) {
            $errors = implode(',', $this->error_bag);

            throw new MissingConfig("[$errors] should not be empty");
        }

        return;
    }

    protected function getConfigUrl()
    {
        return $this->config['base_url'];
    }

    protected function getConfigProject()
    {
        return $this->config['project_id'];
    }
}
