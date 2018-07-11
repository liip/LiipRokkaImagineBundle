<?php

namespace Liip\RokkaImagineBundle\Config\Stack\Operation\Type;

use Liip\ImagineBundle\Config\Filter\Type\Scale;
use Liip\ImagineBundle\Config\FilterInterface;
use Liip\RokkaImagineBundle\Exception\Config\Operation\NotSupportedException;
use Rokka\Client\Core\StackOperation;

class ScaleBuilder extends BuilderAbstract
{
    protected $filterTypeClassName = Scale::class;

    public function build(FilterInterface $filter): StackOperation
    {
        $this->validateFilterType($filter);
        $options = [
            'upscale' => true,
        ];

        if (null !== $filter->getDimensions()->getWidth()) {
            $options['width'] = $filter->getDimensions()->getWidth();
        }

        if (null !== $filter->getDimensions()->getHeight()) {
            $options['height'] = $filter->getDimensions()->getHeight();
        }

        if (null !== $filter->getTo()) {
            throw new NotSupportedException("Option 'to' is not supported in 'scale' operation.");
        }

        return $this->stackOperationFactory->create('resize', $options);
    }
}
