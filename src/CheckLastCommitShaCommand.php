<?php

namespace Console;

use Console\contracts\GitServiceInterface;
use Console\HtmlParser\DiDom;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CheckLastCommitShaCommand
 * @package Console
 */
class CheckLastCommitShaCommand extends SymfonyCommand
{
    const SERVICE_NAMESPACE = 'GitService';
    const OPTION_DEFAULT_SERVICE = 'github';

    protected $serviceName;

    public function configure()
    {
        $this
            ->setName('check')
            ->setDescription('Check the last commit sha for given repo and branch.')
            ->addArgument('repo', InputArgument::REQUIRED, 'Git repository [user/repo].')
            ->addArgument('branch', InputArgument::REQUIRED, 'Git repository branch')
            ->addOption('service', 's', InputOption::VALUE_OPTIONAL, 'Service hosting the repo',
                'github');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $service = $input->getOption('service');

        if (!$this->checkService($service)) {
            throw new InvalidArgumentException('Unknown service '.$service);
        }

        $serviceClass = 'Console\\'.self::SERVICE_NAMESPACE.'\\'.$this->serviceName;

        /** @var GitServiceInterface $service */
        $service = new $serviceClass(new DiDom());
        $service->setRepo($input->getArgument('repo'));
        $service->setBranch($input->getArgument('branch'));

        try {
            $output->writeln($service->getSha());
        } catch (\RuntimeException $e) {
            throw new InvalidArgumentException('Could not find specified repo/branch');
        }
    }

    /**
     * @param string $service
     * @return bool
     */
    protected function checkService(string $service)
    {
        $di = new \DirectoryIterator('./src/'.self::SERVICE_NAMESPACE);

        foreach ($di as $item) {
            if ($item->isFile()) {
                $foundService = $item->getBasename('.php');

                if (strtolower($service) === strtolower($foundService)) {
                    $this->serviceName = $foundService;
                    return true;
                }
            }
        }

        return false;
    }
}
