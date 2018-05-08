<?php
declare(strict_types=1);

namespace PHPUG\Command;

use Selami\Console\Command as SelamiCommand;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use PHPUG\Service\Github as GithubService;

class GetGithubTeamMembers extends SelamiCommand
{
    protected function configure() : void
    {
        $this
            ->setName('github:team-members')
            ->setDescription('Show basic information about Github team members')
            ->setDefinition([
                new InputArgument('organization-name', InputArgument::REQUIRED),
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
        $organizationName = $input->getArgument('organization-name');
        $outputPath = $input->getArgument('output-path');
        $output->write(
            date('Y-m-d H:i:s') .
            ' - Getting github team members for ' .
            $organizationName .
            PHP_EOL
        );
        /**
         * @var $github GithubService;
         */
        $github = $this->container->get(GithubService::class);
        $teamMembers = $github->getTeamMembers($organizationName);
        $fileOutput = json_encode($teamMembers, JSON_PRETTY_PRINT);
        file_put_contents($outputPath, $fileOutput);
        $output->write(date('Y-m-d H:i:s') .' - Data written in the file ' . $outputPath . PHP_EOL);
    }
}
