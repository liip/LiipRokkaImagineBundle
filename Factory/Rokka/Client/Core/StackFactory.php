<?php

namespace Liip\RokkaImagineBundle\Factory\Rokka\Client\Core;

use Rokka\Client\Core\Stack;

class StackFactory
{
    public function create(
        $organization = null,
        $name = null,
        array $stackOperations = [],
        array $stackOptions = [],
        \DateTime $created = null
    ): Stack {
        return new Stack($organization, $name, $stackOperations, $stackOptions, $created);
    }
}
