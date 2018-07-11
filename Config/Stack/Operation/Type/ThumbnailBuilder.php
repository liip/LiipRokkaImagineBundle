<?php

namespace Liip\RokkaImagineBundle\Config\Stack\Operation\Type;

use Liip\ImagineBundle\Config\Filter\Type\Downscale;
use Liip\ImagineBundle\Config\Filter\Type\Thumbnail;
use Liip\ImagineBundle\Config\FilterInterface;
use Liip\RokkaImagineBundle\Exception\Config\Operation\NotSupportedException;
use Rokka\Client\Core\StackOperation;

class ThumbnailBuilder extends BuilderAbstract
{
    protected $filterTypeClassName = Thumbnail::class;

    public function build(FilterInterface $filter): StackOperation
    {
        $this->validateFilterType($filter);
        $options = [
            'mode' => 'box',
        ];

        if (null !== $filter->getSize()->getWidth()) {
            $options['width'] = $filter->getSize()->getWidth();
        }

        if (null !== $filter->getSize()->getHeight()) {
            $options['height'] = $filter->getSize()->getHeight();
        }

        if (null !== $filter->isAllowUpscale()) {
            $options['upscale'] = $filter->isAllowUpscale();
        }

        return $this->stackOperationFactory->create('resize', $options);
    }
}
