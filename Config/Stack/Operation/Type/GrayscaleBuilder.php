<?php

namespace Liip\RokkaImagineBundle\Config\Stack\Operation\Type;

use Liip\ImagineBundle\Config\Filter\Type\Grayscale;
use Liip\ImagineBundle\Config\FilterInterface;
use Rokka\Client\Core\StackOperation;

class GrayscaleBuilder extends BuilderAbstract
{
    protected $filterTypeClassName = Grayscale::class;

    public function build(FilterInterface $filter): StackOperation
    {
        $this->validateFilterType($filter);

        return $this->stackOperationFactory->create('grayscale');
    }
}
