<?php

namespace Liip\RokkaImagineBundle\Config\Stack\Operation\Type;

use Liip\ImagineBundle\Config\Filter\Type\Crop;
use Liip\ImagineBundle\Config\FilterInterface;
use Rokka\Client\Core\StackOperation;

class CropBuilder extends BuilderAbstract
{
    protected $filterTypeClassName = Crop::class;

    public function build(FilterInterface $filter): StackOperation
    {
        $this->validateFilterType($filter);
        $options = [];

        if (null !== $filter->getSize()->getWidth()) {
            $options['width'] = $filter->getSize()->getWidth();
        }

        if (null !== $filter->getSize()->getHeight()) {
            $options['height'] = $filter->getSize()->getHeight();
        }

        if (null !== $filter->getStartPoint()) {
            $options['anchor'] = sprintf(
                "%s_%s",
                $filter->getStartPoint()->getX(),
                $filter->getStartPoint()->getY()
            );
        }

        return $this->stackOperationFactory->create('crop', $options);
    }
}
