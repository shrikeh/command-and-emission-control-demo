<?php

namespace Shrikeh\CommandAndEmissionControlDemo\Listener;

use Shrikeh\CommandAndEmissionControlDemo\Event\SpeakerShowedUpSober;
use Shrikeh\CommandAndEmissionControlDemo\Service\JoinedIn;

/**
 * Class RegisterSpeakerShowedUp.
 */
final class RegisterSpeakerShowedUp
{
    /**
     * @var JoinedIn
     */
    private $joinedInService;

    /**
     * RegisterSpeakerShowedUp constructor.
     *
     * @param JoinedIn $joinedInService
     */
    public function __construct(JoinedIn $joinedInService)
    {
        $this->joinedInService = $joinedInService;
    }

    /**
     * @param SpeakerShowedUpSober $event
     */
    public function __invoke(SpeakerShowedUpSober $event)
    {
        $this->joinedInService->rateTalk($event->talk());
    }
}
