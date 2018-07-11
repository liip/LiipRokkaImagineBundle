<?php

namespace Liip\RokkaImagineBundle\Config\Stack\Operation\Type;

use Liip\ImagineBundle\Config\Filter\Type\Upscale;
use Liip\ImagineBundle\Config\FilterInterface;
use Liip\RokkaImagineBundle\Exception\Config\Operation\NotSupportedException;
use Rokka\Client\Core\StackOperation;

class UpscaleBuilder extends BuilderAbstract
{
    protected $filterTypeClassName = Upscale::class;

    public function build(FilterInterface $filter): StackOperation
    {
        $this->validateFilterType($filter);
        $options = [];

        if (null !== $filter->getMin()->getWidth()) {
            $options['width'] = $filter->getMin()->getWidth();
        }

        if (null !== $filter->getMin()->getHeight()) {
            $options['height'] = $filter->getMin()->getHeight();
        }

        if (null !== $filter->getBy()) {
            throw new NotSupportedException("Option 'by' is not supported in 'upscale' operation.");
        }

        return $this->stackOperationFactory->create('resize', $options);
    }
}
