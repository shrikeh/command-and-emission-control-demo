<?php

namespace Shrikeh\CommandAndEmissionControlDemo\Event;

use Shrikeh\CommandAndEmissionControlDemo\Talk;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class SpeakerShowedUpSober.
 */
final class SpeakerShowedUpSober extends Event
{
    const NAME = 'speaker.showed_up.sober';

    /**
     * @var Talk
     */
    private $talk;

    /**
     * SpeakerShowedUpSober constructor.
     *
     * @param Talk $talk
     */
    public function __construct(Talk $talk)
    {
        $this->talk = $talk;
    }

    /**
     * @return Talk
     */
    public function talk(): Talk
    {
        return $this->talk;
    }
}
