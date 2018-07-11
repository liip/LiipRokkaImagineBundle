<?php

namespace Liip\RokkaImagineBundle\Config\Stack\Operation\Type;

use Liip\ImagineBundle\Config\Filter\Type\Watermark;
use Liip\ImagineBundle\Config\FilterInterface;
use Liip\RokkaImagineBundle\Exception\Config\Operation\NotSupportedException;
use Rokka\Client\Core\StackOperation;

class WatermarkBuilder extends BuilderAbstract
{
    protected $filterTypeClassName = Watermark::class;

    public function build(FilterInterface $filter): StackOperation
    {
        $this->validateFilterType($filter);

        throw new NotSupportedException("Filter 'watermark' is not supported.");
    }
}
