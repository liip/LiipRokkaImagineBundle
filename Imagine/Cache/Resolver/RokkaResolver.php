<?php

namespace Liip\RokkaImagineBundle\Imagine\Cache\Resolver;

use Liip\ImagineBundle\Binary\BinaryInterface;
use Liip\ImagineBundle\Imagine\Cache\Resolver\ResolverInterface;
use Liip\RokkaImagineBundle\Config\BundleConfig;
use Liip\RokkaImagineBundle\Config\RokkaCredentials;
use Liip\RokkaImagineBundle\Exception\Imagine\NotImplementedException;
use Liip\RokkaImagineBundle\Factory\Rokka\Client\TemplateHelperFactory;
use Rokka\Client\TemplateHelper;

class RokkaResolver implements ResolverInterface
{
    /**
     * @var TemplateHelper
     */
    private $templateHelper;

    /**
     * @var TemplateHelperFactory
     */
    private $templateHelperFactory;

    /**
     * @var RokkaCredentials
     */
    private $rokkaCredentials;

    /**
     * @var BundleConfig
     */
    private $bundleConfig;

    public function __construct(
        TemplateHelperFactory $templateHelperFactory,
        RokkaCredentials $rokkaCredentials,
        BundleConfig $bundleConfig
    ) {
        $this->templateHelperFactory = $templateHelperFactory;
        $this->rokkaCredentials = $rokkaCredentials;
        $this->bundleConfig = $bundleConfig;
    }

    /**
     * {@inheritdoc}
     */
    public function isStored($path, $filter)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function store(BinaryInterface $binary, $path, $filter)
    {
        throw new NotImplementedException();
    }

    /**
     * {@inheritdoc}
     */
    public function remove(array $paths, array $filters)
    {
        throw new NotImplementedException();
    }

    /**
     * {@inheritdoc}
     */
    public function resolve($path, $filter)
    {
        return $this->getTemplateHelper()->getStackUrl(
            $this->bundleConfig->getImagesDirectory() . $path,
            $filter,
            pathinfo($path, PATHINFO_EXTENSION)
        );
    }

    private function getTemplateHelper(): TemplateHelper
    {
        if (null === $this->templateHelper) {
            $this->templateHelper = $this->templateHelperFactory->create(
                $this->rokkaCredentials->getOrganization(),
                $this->rokkaCredentials->getApiKey()
            );
        }
        return $this->templateHelper;
    }
}
