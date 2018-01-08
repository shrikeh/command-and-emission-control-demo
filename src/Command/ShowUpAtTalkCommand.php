<?php

namespace Shrikeh\CommandAndEmissionControlDemo\Command;

use DateTime;
use DateTimeImmutable;
use Shrikeh\CommandAndEmissionControlDemo\Command\Exception\InvalidEndTime;
use Shrikeh\CommandAndEmissionControlDemo\Command\Exception\InvalidTalkDateTimeInterface;
use Shrikeh\CommandAndEmissionControlDemo\Command\Exception\StartTimeInThePast;
use Shrikeh\CommandAndEmissionControlDemo\Speaker;
use Shrikeh\CommandAndEmissionControlDemo\Venue;

/**
 * Class ShowUpAtTalkCommand.
 */
final class ShowUpAtTalkCommand
{
    /**
     * @var Speaker
     */
    private $speaker;

    /**
     * @var Venue
     */
    private $venue;

    /**
     * @var DateTimeImmutable
     */
    private $start;

    /**
     * @var DateTimeImmutable
     */
    private $end;

    /**
     * ShowUpAtTalkCommand constructor.
     *
     * @param Speaker  $speaker The speaker expected to show up
     * @param Venue    $venue   The Venue the speaker is expected to be at sober
     * @param dateTime $start   The start time of the talk
     * @param DateTime $end     The time the audience has had enough
     *
     * @throws InvalidTalkDateTimeInterface
     */
    public function __construct(
        Speaker $speaker,
        Venue $venue,
        DateTime $start,
        DateTime $end
    ) {
        $this->validateStartEndDateTimes($start, $end);
        $this->speaker = $speaker;
        $this->venue = $venue;
        $this->start = DateTimeImmutable::createFromMutable($start);
        $this->end = DateTimeImmutable::createFromMutable($end);
    }

    /**
     * Returns the Speaker.
     *
     * @return Speaker
     */
    public function speaker(): Speaker
    {
        return $this->speaker;
    }

    /**
     * Returns the Venue.
     *
     * @return Venue
     */
    public function venue(): Venue
    {
        return $this->venue;
    }

    /**
     * The start time of the talk.
     *
     * @return DateTimeImmutable
     */
    public function start(): DateTimeImmutable
    {
        return $this->start;
    }

    /**
     * Returns the expected time the audience will check their phones.
     *
     * @return DateTimeImmutable
     */
    public function end(): DateTimeImmutable
    {
        return $this->end;
    }

    /**
     * Validates the start and end DateTimes during instantiation.
     *
     * @param DateTime $start
     * @param DateTime $end
     *
     * @throws InvalidTalkDateTimeInterface if the date times are invalid
     */
    private function validateStartEndDateTimes(DateTime $start, DateTime $end)
    {
        if ($start >= $end) {
            throw InvalidEndTime::fromTalkDateTimes($start, $end);
        }
        if (!($start > new DateTime())) {
            throw StartTimeInThePast::fromStartDateTime($start);
        }
    }
}
