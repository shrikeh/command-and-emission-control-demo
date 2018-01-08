<?php

namespace Shrikeh\CommandAndEmissionControlDemo\Talk\Exception;

use DateTime;
use DomainException;

/**
 * Class StartTimeInThePast.
 */
final class InvalidTalkEndTime extends DomainException implements InvalidTalkDateTimeInterface
{
    /**
     * @param DateTime $end
     * @param DateTime $start
     *
     * @return InvalidTalkEndTime
     */
    public static function fromTalkDateTimes(DateTime $start, DateTime $end): self
    {
        $msg = 'The end date/time %s must be after the start date/time %s';

        return new self(\sprintf(
            $msg,
            $end->format(self::DATE_FORMAT),
            $start->format(self::DATE_FORMAT)
        ));
    }
}
