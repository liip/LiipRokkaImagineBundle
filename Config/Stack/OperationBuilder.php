<?php

namespace Liip\RokkaImagineBundle\Config\Stack;

use Liip\ImagineBundle\Config\FilterInterface;
use Liip\RokkaImagineBundle\Config\Stack\Operation\TypeBuilderCollection;
use Rokka\Client\Core\StackOperation;

class OperationBuilder
{
    /**
     * @var TypeBuilderCollection
     */
    private $typeBuilderCollection;

    public function __construct(TypeBuilderCollection $typeBuilderCollection)
    {
        $this->typeBuilderCollection = $typeBuilderCollection;
    }

    public function build(FilterInterface $filter): StackOperation
    {
        return $this->typeBuilderCollection
            ->getByName($filter->getName())
            ->build($filter);
    }
}
