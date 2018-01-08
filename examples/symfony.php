<?php

use Shrikeh\CommandAndEmissionControlDemo\Event\SpeakerShowedUpSober;
use Shrikeh\CommandAndEmissionControlDemo\Listener\RegisterSpeakerShowedUp;
use Shrikeh\CommandAndEmissionControlDemo\Speaker;
use Shrikeh\CommandAndEmissionControlDemo\Talk;
use Shrikeh\CommandAndEmissionControlDemo\Venue;
use Symfony\Component\EventDispatcher\EventDispatcher;

require_once __DIR__.'/../vendor/autoload.php';

/** @var Psr\Container\ContainerInterface $diContainer */
$diContainer = require __DIR__.'/di.php';

// Setup the event bus
$eventBus = new EventDispatcher();


// Register event listeners
$eventBus->addListener(
    SpeakerShowedUpSober::NAME,
    $diContainer->get(RegisterSpeakerShowedUp::class)
);

$start = Carbon\Carbon::tomorrow();
$end = $start->copy()->addHour();

//Set up the domain object as an event payload
$talk = new Talk(
    Speaker::fromName('Barney Hanlon'),
    Venue::fromString('PHP SW @ Basekit'),
    $start,
    $end
);
// And dispatch the event to the bus
$eventBus->dispatch(SpeakerShowedUpSober::NAME, new SpeakerShowedUpSober($talk));


