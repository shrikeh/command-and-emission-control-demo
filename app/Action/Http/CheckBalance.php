<?php
namespace App\Action\Http;

use App\Responder\HttpResponderInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Ramsey\Uuid\Uuid;
use Shrikeh\CommandAndEmissionControlDemo\Command\CheckUserBalance;
use Shrikeh\CommandAndEmissionControlDemo\CommandBusInterface;

/**
 * Class CheckBalance
 */
final class CheckBalance
{
    const HEADER_USER_ID = 'X_USER_ID';

    /**
     * @var CommandBusInterface
     */
    private $commandBus;

    /**
     * @var HttpResponderInterface
     */
    private $responder;

    /**
     * CheckBalance constructor.
     * @param CommandBusInterface $commandBus
     * @param HttpResponderInterface $responder
     */
    public function __construct(CommandBusInterface $commandBus, HttpResponderInterface $responder)
    {
        $this->commandBus = $commandBus;
        $this->responder = $responder;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $userId = Uuid::fromString($request->getHeaderLine(self::HEADER_USER_ID));
        $this->commandBus->execute(new CheckUserBalance($userId));

        return $this->responder->respond();
    }
}
