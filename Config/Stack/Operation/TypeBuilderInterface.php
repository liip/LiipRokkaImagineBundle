<?php

namespace Liip\RokkaImagineBundle\Config\Stack\Operation;

use Liip\ImagineBundle\Config\FilterInterface;
use Rokka\Client\Core\StackOperation;

interface TypeBuilderInterface
{
    public function getName(): string;

    public function build(FilterInterface $filter): StackOperation;
}
