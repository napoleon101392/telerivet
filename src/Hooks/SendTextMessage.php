<?php

namespace Napoleon\Telerivet\Hooks;

use Napoleon\Telerivet\Contracts\TelerivateInterface;

class SendTextMessage implements TelerivateInterface
{
    public function endpoint()
    {
        return 'messages/send';
    }
}
