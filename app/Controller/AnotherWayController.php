<?php

namespace App\Controller;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use InvalidArgumentException;
use League\Tactician\CommandBus;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Shrikeh\CommandAndEmissionControlDemo\Command\Exception\InvalidTalkDateTimeInterface;
use Shrikeh\CommandAndEmissionControlDemo\Command\ShowUpAtTalkCommand;
use Shrikeh\CommandAndEmissionControlDemo\Speaker;
use Shrikeh\CommandAndEmissionControlDemo\Venue;
use Teapot\StatusCode;

/**
 * Class AnotherWayController
 * @package App\Controller
 */
final class AnotherWayController
{
    const HEADER_VENUE = 'X-VENUE';

    const DATE_FORMAT = 'c';

    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * AnotherWayController constructor.
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function bookSpeakerToShowUpAction(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $venue = Venue::fromString($request->getHeader(self::HEADER_VENUE));
            $speaker = Speaker::fromName($request->getAttribute('speaker'));
            $startTime = Carbon::createFromFormat(self::DATE_FORMAT, $request->getAttribute('start_time'));
            $endTime = Carbon::createFromFormat(self::DATE_FORMAT, $request->getAttribute('end_time'));

            $command = new ShowUpAtTalkCommand(
                $speaker,
                $venue,
                $startTime,
                $endTime
            );
            $this->commandBus->handle($command);

            return new Response(StatusCode::CREATED);

        } catch (InvalidTalkDateTimeInterface $e) {
            return new Response(StatusCode::NOT_ACCEPTABLE);
        } catch (InvalidArgumentException $e) {
            return new Response(StatusCode::IM_A_TEAPOT);
        }
    }
}
