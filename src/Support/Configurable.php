<?php

namespace Napoleon\Telerivet\Support;

use Napoleon\Telerivet\Exceptions\MissingConfig;
use Napoleon\Telerivet\Exceptions\MissingSettings;

trait Configurable
{
    public $error_bag = [];

    public $config = [];

    public function setEnv($env)
    {
        return $this->setUp($env);
    }

    public function setUp($env)
    {
        if (!is_null($env)) {
            $this->validateEnv($env);

            $this->config = [
                'base_url'   => $env['base_url'],
                'project_id' => $env['project_id'],
                'api_key'    => $env['api_key'],
            ];
        }

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
}
