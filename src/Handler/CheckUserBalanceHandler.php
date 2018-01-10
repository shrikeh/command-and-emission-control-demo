<?php
namespace Shrikeh\CommandAndEmissionControlDemo\Handler;

use Shrikeh\CommandAndEmissionControlDemo\Command\CheckUserBalance;
use Shrikeh\CommandAndEmissionControlDemo\Event\UserBalanceWasChecked;
use Shrikeh\CommandAndEmissionControlDemo\EventBusInterface;
use Shrikeh\CommandAndEmissionControlDemo\Service\AuthorizationService;
use Shrikeh\CommandAndEmissionControlDemo\Service\Ledger;

final class CheckUserBalanceHandler
{
    /**
     * @var AuthorizationService
     */
    private $authorization;

    /**
     * @var Ledger
     */
    private $ledger;

    /**
     * @var EventBusInterface
     */
    private $eventBus;

    /**
     * CheckUserBalanceHandler constructor.
     * @param AuthorizationService $authorization
     * @param Ledger $ledger
     * @param EventBusInterface $eventBus
     */
    public function __construct(AuthorizationService $authorization, Ledger $ledger, EventBusInterface $eventBus)
    {
        $this->authorization = $authorization;
        $this->ledger = $ledger;
        $this->eventBus = $eventBus;
    }


    /**
     * @param CheckUserBalance $command
     */
    public function handle(CheckUserBalance $command)
    {
        $userId = $command->userId();
        if ($this->authorization->isAuthorized($userId)) {
            $this->eventBus->emit(new UserBalanceWasChecked(
                $userId,
                $this->ledger->balanceFor($userId)
            ));
        }
    }
}
