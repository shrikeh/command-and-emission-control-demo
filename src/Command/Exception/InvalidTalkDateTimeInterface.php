<?php

namespace Shrikeh\CommandAndEmissionControlDemo\Command\Exception;

use Throwable;

/**
 * Interface InvalidTalkInterface.
 */
interface InvalidTalkDateTimeInterface extends Throwable
{
    const DATE_FORMAT = 'c';
}
