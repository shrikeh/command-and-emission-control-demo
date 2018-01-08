<?php
namespace App\Console;

use Carbon\Carbon;
use InvalidArgumentException;
use Shrikeh\CommandAndEmissionControlDemo\Speaker;
use Shrikeh\CommandAndEmissionControlDemo\Talk;
use Shrikeh\CommandAndEmissionControlDemo\Venue;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class StandardRateCommand extends Command
{
    const INPUT_SPEAKER = 'speaker';
    const INPUT_VENUE = 'venue';
    const INPUT_START = 'start';
    const INPUT_END = 'end';


    protected function configure()
    {
        $this->setDescription('Rates a speaker talk');
        $this->addArgument(
            self::INPUT_SPEAKER,
            InputArgument::REQUIRED,
            'The speaker at the venue'
        );

        $this->addArgument(
            self::INPUT_VENUE,
            InputArgument::REQUIRED,
            'The name of the venue'
        );

        $this->addArgument(
            self::INPUT_START,
            InputArgument::REQUIRED,
            'The start time of the talk'
        );

        $this->addArgument(
            self::INPUT_END,
            InputArgument::REQUIRED,
            'The time everyone threw rotten vegetables'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $venue = Venue::fromString($input->getArgument(self::INPUT_VENUE));
            $speaker = Speaker::fromName($input->getArgument(self::INPUT_SPEAKER));
            $startTime = Carbon::createFromFormat(self::DATE_FORMAT, $input->getArgument('start_time'));
            $endTime = Carbon::createFromFormat(self::DATE_FORMAT, $input->getArgument('end_time'));

            $talk = new Talk(
                $speaker,
                $venue,
                $startTime,
                $endTime
            );

            $this->joinedInService->rateTalk($talk);

            $output->writeln('Joined in told about talk');
        } catch (Talk\Exception\InvalidTalkEndTime $e) {
            $output->writeln('Naughty end time');
        } catch (InvalidArgumentException $e) {
            $output->writeln('You bad typer');
        }
    }
}
