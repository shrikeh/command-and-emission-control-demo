<?php

namespace Shrikeh\CommandAndEmissionControlDemo;

/**
 * Class Venue.
 */
final class Venue
{
    /**
     * @var string
     */
    private $venueName;

    /**
     * @param string $venueName
     *
     * @return Venue
     */
    public static function fromString(string $venueName): self
    {
        return new self($venueName);
    }

    /**
     * Venue constructor.
     *
     * @param string $venueName
     */
    public function __construct($venueName)
    {
        $this->venueName = $venueName;
    }
}
