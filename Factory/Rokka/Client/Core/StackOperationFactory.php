<?php

namespace Liip\RokkaImagineBundle\Factory\Rokka\Client\Core;

use Rokka\Client\Core\StackOperation;

class StackOperationFactory
{
    public function create(string $name, array $options = []): StackOperation
    {
        return new StackOperation($name, $options);
    }
}
