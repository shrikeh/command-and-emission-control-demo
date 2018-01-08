<?php

namespace Shrikeh\CommandAndEmissionControlDemo\Handler;

use Shrikeh\CommandAndEmissionControlDemo\Command\ShowUpAtTalkCommand;
use Shrikeh\CommandAndEmissionControlDemo\Service\ResponsibilityProdder;

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
     * ShowUpAtTalkCommandHandler constructor.
     *
     * @param ResponsibilityProdder $responsibilityProdder
     */
    public function __construct(ResponsibilityProdder $responsibilityProdder)
    {
        $this->responsibilityProdder = $responsibilityProdder;
    }

    /**
     * @param ShowUpAtTalkCommand $command
     */
    public function handle(ShowUpAtTalkCommand $command)
    {
        $this->responsibilityProdder->remindSpeakerOfProfessionalism($command->speaker());
    }
}
