<?php

namespace Liip\RokkaImagineBundle\Config\Stack\Operation\Type;

use Liip\ImagineBundle\Config\Filter\Type\Downscale;
use Liip\ImagineBundle\Config\FilterInterface;
use Liip\RokkaImagineBundle\Exception\Config\Operation\NotSupportedException;
use Rokka\Client\Core\StackOperation;

class DownscaleBuilder extends BuilderAbstract
{
    protected $filterTypeClassName = Downscale::class;

    public function build(FilterInterface $filter): StackOperation
    {
        $this->validateFilterType($filter);
        $options = [];

        if (null !== $filter->getMax()->getWidth()) {
            $options['width'] = $filter->getMax()->getWidth();
        }

        if (null !== $filter->getMax()->getHeight()) {
            $options['height'] = $filter->getMax()->getHeight();
        }

        if (null !== $filter->getBy()) {
            throw new NotSupportedException("Option 'by' is not supported in 'downscale' operation.");
        }

        return $this->stackOperationFactory->create('resize', $options);
    }
}
