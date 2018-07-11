<?php

namespace Liip\RokkaImagineBundle\Config\Stack\Operation\Type;

use Liip\ImagineBundle\Config\Filter\Type\Resize;
use Liip\ImagineBundle\Config\FilterInterface;
use Rokka\Client\Core\StackOperation;

class ResizeBuilder extends BuilderAbstract
{
    protected $filterTypeClassName = Resize::class;

    public function build(FilterInterface $filter): StackOperation
    {
        $this->validateFilterType($filter);
        $options = [
            'mode' => 'absolute',
        ];

        if (null !== $filter->getSize()->getWidth()) {
            $options['width'] = $filter->getSize()->getWidth();
        }

        if (null !== $filter->getSize()->getHeight()) {
            $options['height'] = $filter->getSize()->getHeight();
        }

        return $this->stackOperationFactory->create('resize', $options);
    }
}
