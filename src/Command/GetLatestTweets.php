<?php
declare(strict_types=1);

namespace PHPUG\Command;

use Selami\Console\Command as SelamiCommand;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use PHPUG\Service\Twitter as TwitterService;

class GetLatestTweets extends SelamiCommand
{
    protected function configure() : void
    {
        $this
            ->setName('twitter:latest-tweets')
            ->setDescription('Gets latest tweets of user')
            ->setDefinition([
                new InputArgument('handle-name', InputArgument::REQUIRED),
                new InputArgument('output-path', InputArgument::REQUIRED),
            ]);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @throws InvalidArgumentException
     */
    protected function execute(InputInterface $input, OutputInterface $output) : void
    {
        $handleName = $input->getArgument('handle-name');
        $outputPath = $input->getArgument('output-path');
        $output->write(
            date('Y-m-d H:i:s') .
            ' - Getting latest tweets for ' .
            $handleName .
            PHP_EOL
        );
        /**
         * @var $github TwitterService;
         */
        $github = $this->container->get(TwitterService::class);
        $tweets = $github->getLatestTweets($handleName);
        $fileOutput = json_encode($tweets, JSON_PRETTY_PRINT);
        file_put_contents($outputPath, $fileOutput);
        $output->write(date('Y-m-d H:i:s') .' - Data written in the file ' . $outputPath . PHP_EOL);
    }
}
