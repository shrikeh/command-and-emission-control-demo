<?php

namespace Shrikeh\CommandAndEmissionControlDemo\Event;

use Ramsey\Uuid\UuidInterface;

final class UserBalanceWasChecked
{
    /**
     * @var UuidInterface
     */
    private $userId;

    /**
     * @var float
     */
    private $balance;

    /**
     * UserBalanceWasChecked constructor.
     * @param UuidInterface $userId
     * @param float $balance
     */
    public function __construct(UuidInterface $userId, $balance)
    {
        $this->userId = $userId;
        $this->balance = $balance;
    }

    /**
     * @return UuidInterface
     */
    public function userId(): UuidInterface
    {
        return $this->userId;
    }

    /**
     * @return float
     */
    public function balance(): float
    {
        return $this->balance;
    }
}
