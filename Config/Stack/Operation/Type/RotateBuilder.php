<?php

namespace Liip\RokkaImagineBundle\Config\Stack\Operation\Type;

use Liip\ImagineBundle\Config\Filter\Type\Rotate;
use Liip\ImagineBundle\Config\FilterInterface;
use Rokka\Client\Core\StackOperation;

class RotateBuilder extends BuilderAbstract
{
    protected $filterTypeClassName = Rotate::class;

    public function build(FilterInterface $filter): StackOperation
    {
        $this->validateFilterType($filter);

        if (null === $filter->getAngle()) {
            throw new \InvalidArgumentException("Required option 'angle' is not defined.");
        }

        return $this->stackOperationFactory->create('rotate', [
            'angle' => $filter->getAngle(),
        ]);
    }
}
