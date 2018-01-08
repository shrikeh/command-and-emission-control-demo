<?php

namespace Shrikeh\CommandAndEmissionControlDemo;

use DateTime;
use DateTimeImmutable;
use Shrikeh\CommandAndEmissionControlDemo\Talk\Exception\InvalidTalkEndTime;

/**
 * Class Talk.
 */
final class Talk
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
     * @throws InvalidTalkEndTime
     */
    public function __construct(
        Speaker $speaker,
        Venue $venue,
        DateTime $start,
        DateTime $end
    ) {
        $this->validateTalkStartEndDateTimes($start, $end);
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
     * @throws InvalidTalkEndTime if the date times are invalid
     */
    private function validateTalkStartEndDateTimes(DateTime $start, DateTime $end)
    {
        if ($start >= $end) {
            throw InvalidTalkEndTime::fromTalkDateTimes($start, $end);
        }
    }
}
