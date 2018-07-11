<?php

namespace Liip\RokkaImagineBundle\Config\Stack\Operation\Type;

use Liip\ImagineBundle\Config\Filter\Type\Flip;
use Liip\ImagineBundle\Config\FilterInterface;
use Liip\RokkaImagineBundle\Exception\Config\Operation\NotSupportedException;
use Rokka\Client\Core\StackOperation;

class FlipBuilder extends BuilderAbstract
{
    protected $filterTypeClassName = Flip::class;

    public function build(FilterInterface $filter): StackOperation
    {
        $this->validateFilterType($filter);

        throw new NotSupportedException("Filter 'flip' is not supported.");
    }
}
