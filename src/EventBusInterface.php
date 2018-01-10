<?php
namespace Shrikeh\CommandAndEmissionControlDemo;

interface EventBusInterface
{
    public function emit($event);
}
