<?php

namespace Shrikeh\CommandAndEmissionControlDemo\Command;

use Shrikeh\CommandAndEmissionControlDemo\Speaker;

final class InformLineManager
{
    /**
     * @var Speaker
     */
    private $speaker;

    /**
     * InformLineManager constructor.
     * @param Speaker $speaker
     */
    public function __construct(Speaker $speaker)
    {
        $this->speaker = $speaker;
    }
}
