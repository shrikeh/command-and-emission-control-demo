<?php
namespace Shrikeh\CommandAndEmissionControlDemo\Command;

use Ramsey\Uuid\UuidInterface;

/**
 * Class CheckUserBalance
 * @package Shrikeh\CommandAndEmissionControlDemo\Command
 */
final class CheckUserBalance
{
    /**
     * @var UuidInterface
     */
    private $userId;

    /**
     * CheckUserBalance constructor.
     * @param UuidInterface $userId
     */
    public function __construct(UuidInterface $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return UuidInterface
     */
    public function userId(): UuidInterface
    {
        return $this->userId;
    }


}
