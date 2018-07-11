<?php

namespace Liip\RokkaImagineBundle\Config\Stack\Operation\Type;

use Liip\ImagineBundle\Config\Filter\Type\Strip;
use Liip\ImagineBundle\Config\FilterInterface;
use Liip\RokkaImagineBundle\Exception\Config\Operation\NotSupportedException;
use Rokka\Client\Core\StackOperation;

class StripBuilder extends BuilderAbstract
{
    protected $filterTypeClassName = Strip::class;

    public function build(FilterInterface $filter): StackOperation
    {
        $this->validateFilterType($filter);

        throw new NotSupportedException("Filter 'strip' is not supported, because it is automatically done in rokka.");
    }
}
