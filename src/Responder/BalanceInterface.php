<?php
namespace Shrikeh\CommandAndEmissionControlDemo\Responder;

use Ramsey\Uuid\UuidInterface;

interface BalanceInterface
{
    /**
     * @param UuidInterface $userId
     * @param float $balance
     * @return mixed
     */
    public function userBalance(UuidInterface $userId, float $balance);
}
