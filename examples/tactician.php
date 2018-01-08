<?php

use League\Tactician\Setup\QuickStart;
use Shrikeh\CommandAndEmissionControlDemo\Command\ShowUpAtTalkCommand;
use Shrikeh\CommandAndEmissionControlDemo\Handler\ShowUpAtTalkCommandHandler;
use Shrikeh\CommandAndEmissionControlDemo\Speaker;
use Shrikeh\CommandAndEmissionControlDemo\Venue;

require_once __DIR__.'/../vendor/autoload.php';

/** @var Psr\Container\ContainerInterface $diContainer */
$diContainer = require __DIR__.'/di.php';

// setup the Command Bus with a map of commands to handlers
$commandBus = QuickStart::create(
    [
        ShowUpAtTalkCommand::class => $diContainer->get(ShowUpAtTalkCommandHandler::class),
    ]
);

$start = Carbon\Carbon::tomorrow();
$end = $start->copy()->addHour();

// Create the command...
$command = new ShowUpAtTalkCommand(
    Speaker::fromName('Barney Hanlon'),
    Venue::fromString('PHP SW @ Basekit'),
    $start,
    $end
);
// ... And then let the command bus "handle it".
$commandBus->handle($command);
