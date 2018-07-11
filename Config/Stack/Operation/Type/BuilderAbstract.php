<?php

namespace Liip\RokkaImagineBundle\Config\Stack\Operation\Type;

use Liip\ImagineBundle\Config\FilterInterface;
use Liip\RokkaImagineBundle\Config\Stack\Operation\TypeBuilderInterface;
use Liip\RokkaImagineBundle\Factory\Rokka\Client\Core\StackOperationFactory;

abstract class BuilderAbstract implements TypeBuilderInterface
{
    /**
     * @var string
     */
    protected $filterTypeClassName;

    /**
     * @var StackOperationFactory
     */
    protected $stackOperationFactory;

    public function __construct(StackOperationFactory $stackOperationFactory)
    {
        $this->stackOperationFactory = $stackOperationFactory;
    }

    public function getName(): string
    {
        return $this->filterTypeClassName::NAME;
    }

    protected function validateFilterType(FilterInterface $filter)
    {
        if ($filter instanceof $this->filterTypeClassName) {
            return;
        }

        throw new \InvalidArgumentException(sprintf(
            "Invalid filter type provided, '%s' is expected, '%s' is given.",
            $this->filterTypeClassName,
            get_class($filter)
        ));
    }
}
