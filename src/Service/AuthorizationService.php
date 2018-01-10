<?php

namespace Shrikeh\CommandAndEmissionControlDemo\Service;

use Ramsey\Uuid\UuidInterface;

final class AuthorizationService
{
    public function isAuthorized(UuidInterface $userId): bool
    {
        return true;
    }
}
