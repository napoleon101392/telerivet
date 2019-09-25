<?php

namespace Napoleon\Telerivet\Exceptions;

class MissingConfig extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
