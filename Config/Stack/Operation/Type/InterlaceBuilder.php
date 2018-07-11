<?php

namespace Liip\RokkaImagineBundle\Config\Stack\Operation\Type;

use Liip\ImagineBundle\Config\Filter\Type\Interlace;
use Liip\ImagineBundle\Config\FilterInterface;
use Liip\RokkaImagineBundle\Exception\Config\Operation\NotSupportedException;
use Rokka\Client\Core\StackOperation;

class InterlaceBuilder extends BuilderAbstract
{
    protected $filterTypeClassName = Interlace::class;

    public function build(FilterInterface $filter): StackOperation
    {
        $this->validateFilterType($filter);
        throw new NotSupportedException(
            "Filter 'interlace' is not supported, because it is automatically done in rokka."
        );
    }
}
