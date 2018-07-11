<?php

namespace Liip\RokkaImagineBundle\Config\Stack\Operation\Type;

use Liip\ImagineBundle\Config\Filter\Type\Paste;
use Liip\ImagineBundle\Config\FilterInterface;
use Liip\RokkaImagineBundle\Exception\Config\Operation\NotSupportedException;
use Rokka\Client\Core\StackOperation;

class PasteBuilder extends BuilderAbstract
{
    protected $filterTypeClassName = Paste::class;

    public function build(FilterInterface $filter): StackOperation
    {
        $this->validateFilterType($filter);
        throw new NotSupportedException("Filter 'paste' is not supported.");
    }
}
