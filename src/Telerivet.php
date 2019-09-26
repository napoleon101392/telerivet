<?php

namespace Napoleon\Telerivet;

use Napoleon\Telerivet\Contracts\TelerivateInterface;

class Telerivet extends Base
{
    protected $hook;

    public function __construct(TelerivateInterface $hook, $env = [])
    {
        $this->hook = $hook;

        foreach ([$env, $this->hook->config] as $config) {
            $this->setUp($config);
        }
    }

    public function getRequestUrl()
    {
        $combination = [
            $this->getConfigUrl(),
            $this->getConfigProject(),
            $this->hook->endpoint(),
        ];

        return implode('/', $combination);
    }

    public function getEndPoint()
    {
        return $this->hook->endpoint();
    }

    public function getHeaders()
    {
        return $this->hook->headers();
    }
}
