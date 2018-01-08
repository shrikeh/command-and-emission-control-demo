<?php

namespace Shrikeh\CommandAndEmissionControlDemo\Command\Exception;

use DateTime;
use DomainException;

/**
 * Class StartTimeInThePast.
 */
final class StartTimeInThePast extends DomainException implements InvalidTalkDateTimeInterface
{
    /**
     * @param DateTime $start
     *
     * @return StartTimeInThePast
     */
    public static function fromStartDateTime(DateTime $start): self
    {
        $msg = 'The start date %s has already passed';

        return new self(\sprintf($msg, $start->format(self::DATE_FORMAT)));
    }
}
