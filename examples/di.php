<?php

use Shrikeh\CommandAndEmissionControlDemo\Handler\ShowUpAtTalkCommandHandler;
use Shrikeh\CommandAndEmissionControlDemo\Listener\RegisterSpeakerShowedUp;
use Shrikeh\CommandAndEmissionControlDemo\Service\JoinedIn;
use Shrikeh\CommandAndEmissionControlDemo\Service\ResponsibilityProdder;

require_once __DIR__.'/../vendor/autoload.php';

$pimple = new \Pimple\Container();

$pimple[ShowUpAtTalkCommandHandler::class] = function () {
    return new ShowUpAtTalkCommandHandler(new ResponsibilityProdder());
};

$pimple[RegisterSpeakerShowedUp::class]= function () {
    return new RegisterSpeakerShowedUp(new JoinedIn());
};

return new \Pimple\Psr11\Container($pimple);
