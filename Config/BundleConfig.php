<?php

namespace Liip\RokkaImagineBundle\Config;

use Symfony\Component\DependencyInjection\ContainerInterface;

class BundleConfig
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getImagesDirectory(): string
    {
        return $this->container->getParameter('liip_rokka_imagine.images_dir');
    }
}
