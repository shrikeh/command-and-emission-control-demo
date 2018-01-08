<?php

namespace App\Controller;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Shrikeh\CommandAndEmissionControlDemo\Service\JoinedIn;
use Shrikeh\CommandAndEmissionControlDemo\Speaker;
use Shrikeh\CommandAndEmissionControlDemo\Talk;
use Shrikeh\CommandAndEmissionControlDemo\Venue;
use Teapot\StatusCode;

/**
 * Class StandardController.
 */
final class StandardController
{
    const HEADER_VENUE = 'X-VENUE';

    const DATE_FORMAT = 'c';
    /**
     * @var JoinedIn
     */
    private $joinedInService;

    /**
     * StandardController constructor.
     *
     * @param JoinedIn $joinedInService
     */
    public function __construct(JoinedIn $joinedInService)
    {
        $this->joinedInService = $joinedInService;
    }

    /**
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function rateTalkAction(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $venue = Venue::fromString($request->getHeader(self::HEADER_VENUE));
            $speaker = Speaker::fromName($request->getAttribute('speaker'));
            $startTime = Carbon::createFromFormat(self::DATE_FORMAT, $request->getAttribute('start_time'));
            $endTime = Carbon::createFromFormat(self::DATE_FORMAT, $request->getAttribute('end_time'));

            $talk = new Talk(
                $speaker,
                $venue,
                $startTime,
                $endTime
            );

            $this->joinedInService->rateTalk($talk);

            return new Response(StatusCode::CREATED);
        } catch (Talk\Exception\InvalidTalkEndTime $e) {
            return new Response(StatusCode::RANGE_NOT_SATISFIABLE);
        } catch (InvalidArgumentException $e) {
            return new Response(StatusCode::NOT_ACCEPTABLE);
        }
    }
}
