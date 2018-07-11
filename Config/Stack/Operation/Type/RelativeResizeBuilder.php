<?php

namespace Liip\RokkaImagineBundle\Config\Stack\Operation\Type;

use Liip\ImagineBundle\Config\Filter\Type\RelativeResize;
use Liip\ImagineBundle\Config\FilterInterface;
use Liip\RokkaImagineBundle\Exception\Config\Operation\NotSupportedException;
use Rokka\Client\Core\StackOperation;

class RelativeResizeBuilder extends BuilderAbstract
{
    protected $filterTypeClassName = RelativeResize::class;

    public function build(FilterInterface $filter): StackOperation
    {
        $this->validateFilterType($filter);
        $options = [];

        if (null !== $filter->getHeighten()) {
            $options['height'] = $filter->getHeighten();
        }

        if (null !== $filter->getWiden()) {
            $options['width'] = $filter->getWiden();
        }

        if (null !== $filter->getIncrease()) {
            throw new NotSupportedException("Option 'increase' is not supported in 'relative_resize' operation.");
        }

        if (null !== $filter->getScale()) {
            throw new NotSupportedException("Option 'scale' is not supported in 'relative_resize' operation.");
        }

        return $this->stackOperationFactory->create('resize', $options);
    }
}
