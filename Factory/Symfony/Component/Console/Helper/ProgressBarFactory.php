<?php

namespace Liip\RokkaImagineBundle\Factory\Symfony\Component\Console\Helper;

use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\OutputInterface;

class ProgressBarFactory
{
    /**
     * @param OutputInterface $output
     * @param int $max
     * @return ProgressBar
     */
    public function create(OutputInterface $output, int $max)
    {
        return new ProgressBar($output, $max);
    }
}
