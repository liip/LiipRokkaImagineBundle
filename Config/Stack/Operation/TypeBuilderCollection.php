<?php

namespace Liip\RokkaImagineBundle\Config\Stack\Operation;

use Liip\RokkaImagineBundle\Exception\Config\Operation\Builder\NotFoundException;

class TypeBuilderCollection
{
    /**
     * @var TypeBuilderInterface[]
     */
    private $typeBuilderInterfaces;

    public function __construct(TypeBuilderInterface ...$typeBuilderInterfaces)
    {
        foreach ($typeBuilderInterfaces as $typeBuilderInterface) {
            $this->typeBuilderInterfaces[$typeBuilderInterface->getName()] = $typeBuilderInterface;
        }
    }

    /**
     * @param string $name
     * @return TypeBuilderInterface
     * @throws NotFoundException
     */
    public function getByName(string $name): TypeBuilderInterface
    {
        if (!isset($this->typeBuilderInterfaces[$name])) {
            throw new NotFoundException(sprintf(
                "Operation type builder with name '%s' was not found.",
                $name
            ));
        }

        return $this->typeBuilderInterfaces[$name];
    }

    /**
     * @return TypeBuilderInterface[]
     */
    public function getAll(): array
    {
        return $this->typeBuilderInterfaces;
    }
}
