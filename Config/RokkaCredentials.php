<?php

namespace Liip\RokkaImagineBundle\Config;

use Symfony\Component\DependencyInjection\ContainerInterface;

class RokkaCredentials
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getOrganization(): string
    {
        return $this->container->getParameter('liip_rokka_imagine.rokka.organization');
    }

    public function getApiKey(): string
    {
        return $this->container->getParameter('liip_rokka_imagine.rokka.api_key');
    }
}
