<?php

namespace Shrikeh\CommandAndEmissionControlDemo\Handler;

use Shrikeh\CommandAndEmissionControlDemo\Command\ShowUpAtTalkCommand;
use Shrikeh\CommandAndEmissionControlDemo\Event\SpeakerWasRemindedOfProfessionalism;
use Shrikeh\CommandAndEmissionControlDemo\Service\ResponsibilityProdder;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class ShowUpAtTalkCommandHandler.
 */
final class ShowUpAtTalkCommandHandler
{
    /**
     * @var ResponsibilityProdder
     */
    private $responsibilityProdder;

    /**
     * @var EventDispatcherInterface
     */
    private $eventBus;

    /**
     * ShowUpAtTalkCommandHandler constructor.
     * @param ResponsibilityProdder $responsibilityProdder
     * @param EventDispatcherInterface $eventBus
     */
    public function __construct(
        ResponsibilityProdder $responsibilityProdder,
        EventDispatcherInterface $eventBus)
    {
        $this->responsibilityProdder = $responsibilityProdder;
        $this->eventBus = $eventBus;
    }

    /**
     * @param ShowUpAtTalkCommand $command
     */
    public function handle(ShowUpAtTalkCommand $command)
    {
        $speaker = $command->speaker();
        $this->responsibilityProdder->remindSpeakerOfProfessionalism($speaker);
        $this->eventBus->dispatch(
            SpeakerWasRemindedOfProfessionalism::NAME,
            new SpeakerWasRemindedOfProfessionalism($speaker)
        );
    }
}
