<?php

namespace Liip\RokkaImagineBundle\Command;

use Liip\ImagineBundle\Config\StackCollection;
use Liip\RokkaImagineBundle\Config\RokkaCredentials;
use Liip\RokkaImagineBundle\Config\Stack\OperationBuilder;
use Liip\RokkaImagineBundle\Factory\Rokka\Client\Core\StackFactory;
use Liip\RokkaImagineBundle\Factory\Rokka\ImageClientFactory;
use Liip\RokkaImagineBundle\Factory\Symfony\Component\Console\Helper\ProgressBarFactory;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class ConfigSyncCommand extends Command
{
    const NAME = 'liip:rokka-imagine:config:sync';

    /**
     * @var StackCollection
     */
    private $stackCollection;

    /**
     * @var ImageClientFactory
     */
    private $imageClientFactory;

    /**
     * @var RokkaCredentials
     */
    private $rokkaCredentials;

    /**
     * @var StackFactory
     */
    private $stackFactory;

    /**
     * @var OperationBuilder
     */
    private $stackOperationBuilder;

    /**
     * @var ProgressBarFactory
     */
    private $progressBarFactory;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        StackCollection $stackCollection,
        ImageClientFactory $imageClientFactory,
        RokkaCredentials $rokkaCredentials,
        StackFactory $stackFactory,
        OperationBuilder $stackOperationBuilder,
        ProgressBarFactory $progressBarFactory,
        LoggerInterface $logger
    ) {
        $this->stackCollection = $stackCollection;
        $this->imageClientFactory = $imageClientFactory;
        $this->rokkaCredentials = $rokkaCredentials;
        $this->stackFactory = $stackFactory;
        $this->stackOperationBuilder = $stackOperationBuilder;
        $this->progressBarFactory = $progressBarFactory;
        $this->logger = $logger;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName(self::NAME)
            ->setDescription('Imports declared stacks and filters from ImagineBundle to Rokka.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $client = $this->imageClientFactory->create(
                $this->rokkaCredentials->getOrganization(),
                $this->rokkaCredentials->getApiKey()
            );

            $stacks = $this->stackCollection->getStacks();

            $rokkaStacks = [];

            foreach ($stacks as $stack) {
                $rokkaStack = $this->stackFactory->create(null, $stack->getName());

                foreach ($stack->getFilters() as $filter) {
                    try {
                        $rokkaStack->addStackOperation(
                            $this->stackOperationBuilder->build($filter)
                        );
                    } catch (\Exception $exception) {
                        $this->logger->error($exception->getMessage(), $exception->getTrace());
                        $this->logger->warning(sprintf(
                            'Stack %s is skipped due to unresolved filter %s',
                            $stack->getName(),
                            $filter->getName()
                        ));
                        continue 2;
                    }
                }

                $rokkaStacks[] = $rokkaStack;
            }

            if (count($rokkaStacks) == 0) {
                $output->writeln('No stacks to import.');
            }

            $progressBar = $this->progressBarFactory->create($output, count($rokkaStacks));
            $progressBar->start();

            foreach ($rokkaStacks as $rokkaStack) {
                $client->saveStack($rokkaStack, ['overwrite' => true]);
                $this->logger->debug(
                    sprintf('Stack %s has been created on Rokka.', $rokkaStack->getName()),
                    [$rokkaStack]
                );
                $progressBar->advance();
            }

            $progressBar->finish();
            $output->writeln('');
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage(), $exception->getTrace());
            throw $exception;
        }
    }
}
