<?php

namespace Shrikeh\CommandAndEmissionControlDemo\Listener;

use League\Tactician\CommandBus;
use Shrikeh\CommandAndEmissionControlDemo\Command\InformLineManager;
use Shrikeh\CommandAndEmissionControlDemo\Event\SpeakerWasRemindedOfProfessionalism;

final class SpeakerRemindedListener
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @param SpeakerWasRemindedOfProfessionalism $event
     */
    public function __invoke(SpeakerWasRemindedOfProfessionalism $event)
    {
        $this->commandBus->handle(new InformLineManager($event->speaker()));
    }
}
