<?php

namespace Napoleon\Telerivet;

use Napoleon\Telerivet\Contracts\TelerivateInterface;

class Telerivet extends Base
{
    protected $hook;

    public function __construct(TelerivateInterface $hook, $env = null)
    {
        $this->hook = $hook;

        $this->setUp($env);

        if (!empty($this->hook->config)) {
            $this->setUp($this->hook->config);
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
