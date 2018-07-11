<?php

namespace Liip\RokkaImagineBundle\Config\Stack\Operation\Type;

use Liip\ImagineBundle\Config\Filter\Type\AutoRotate;
use Liip\ImagineBundle\Config\FilterInterface;
use Rokka\Client\Core\StackOperation;

class AutoRotateBuilder extends BuilderAbstract
{
    protected $filterTypeClassName = AutoRotate::class;

    public function build(FilterInterface $filter): StackOperation
    {
        $this->validateFilterType($filter);
        return $this->stackOperationFactory->create('autorotate');
    }
}
