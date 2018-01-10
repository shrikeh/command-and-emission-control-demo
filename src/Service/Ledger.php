<?php

namespace Shrikeh\CommandAndEmissionControlDemo\Service;

use Ramsey\Uuid\UuidInterface;

final class Ledger
{
    public function balanceFor(UuidInterface $user): float
    {
        return 100.00;
    }
}
