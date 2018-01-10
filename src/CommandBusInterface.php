<?php
namespace Shrikeh\CommandAndEmissionControlDemo;

/**
 * Interface CommandBusInterface
 * @package Shrikeh\CommandAndEmissionControlDemo
 */
interface CommandBusInterface
{
    /**
     * @param $command
     * @return mixed
     */
    public function execute($command);
}
