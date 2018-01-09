<?php

namespace Shrikeh\CommandAndEmissionControlDemo\Event;

use Shrikeh\CommandAndEmissionControlDemo\Speaker;
use Symfony\Component\EventDispatcher\Event;

final class SpeakerWasRemindedOfProfessionalism extends Event
{
    const NAME = 'speaker.professionalism.reminded';

    /**
     * @var Speaker
     */
    private $speaker;

    /**
     * SpeakerWasRemindedOfProfessionalism constructor.
     * @param Speaker $speaker
     */
    public function __construct(Speaker $speaker)
    {
        $this->speaker = $speaker;
    }

    /**
     * @return Speaker
     */
    public function speaker(): Speaker
    {
        return $this->speaker;
    }
}
