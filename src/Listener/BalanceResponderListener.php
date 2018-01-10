<?php
namespace Shrikeh\CommandAndEmissionControlDemo\Listener;

use Shrikeh\CommandAndEmissionControlDemo\Event\UserBalanceWasChecked;
use Shrikeh\CommandAndEmissionControlDemo\Responder\Balance;

final class BalanceResponderListener
{
    /**
     * @var Balance
     */
    private $balanceResponder;

    /**
     * BalanceResponderListener constructor.
     * @param Balance $balanceResponder
     */
    public function __construct(Balance $balanceResponder)
    {
        $this->balanceResponder = $balanceResponder;
    }

    /**
     * @param UserBalanceWasChecked $event
     */
    public function __invoke(UserBalanceWasChecked $event)
    {
        $this->balanceResponder->userBalance(
            $event->userId(),
            $event->balance()
        );
    }
}
