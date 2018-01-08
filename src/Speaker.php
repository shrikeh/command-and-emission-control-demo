<?php

namespace Shrikeh\CommandAndEmissionControlDemo;

/**
 * Class Speaker.
 */
final class Speaker
{
    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     *
     * @return Speaker
     */
    public static function fromName(string $name): self
    {
        return new self($name);
    }

    /**
     * Speaker constructor.
     *
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }
}
