<?php

namespace Napoleon\Telerivet\Hooks;

use Napoleon\Telerivet\Support\Configurable;
use Napoleon\Telerivet\Contracts\TelerivateInterface;

class SendTextMessage implements TelerivateInterface
{
    use Configurable;

    public function endpoint()
    {
        return 'messages/send';
    }
}
