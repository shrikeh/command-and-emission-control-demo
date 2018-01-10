<?php
namespace App\Responder\Http;

use App\Responder\HttpResponderInterface;
use Psr\Http\Message\ResponseInterface;
use Ramsey\Uuid\UuidInterface;
use Shrikeh\CommandAndEmissionControlDemo\Responder\BalanceInterface;

final class BalanceResponder implements HttpResponderInterface, BalanceInterface
{
    /**
     * @var ResponseInterface
     */
    private $response;
    /**
     * @var \Closure
     */
    private $action;

    /**
     * BalanceResponder constructor.
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
        $this->action = function(ResponseInterface $response) {
            return $response;
        };
    }


    /**
     * @param UuidInterface $userId
     * @param float $balance
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function userBalance(UuidInterface $userId, float $balance)
    {
        $this->action = function(ResponseInterface $response) use ($balance) {
            return $response->withAddedHeader('balance', $balance);
        };
    }

    /**
     * @return ResponseInterface
     */
    public function respond(): ResponseInterface
    {
        $action = $this->action;

        return $action($this->response);
    }
}
