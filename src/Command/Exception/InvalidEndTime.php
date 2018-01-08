<?php

namespace Shrikeh\CommandAndEmissionControlDemo\Command\Exception;

use DateTime;
use DomainException;

/**
 * Class StartTimeInThePast.
 */
final class InvalidEndTime extends DomainException implements InvalidTalkDateTimeInterface
{
    /**
     * @param DateTime $end
     * @param DateTime $start
     *
     * @return InvalidEndTime
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
