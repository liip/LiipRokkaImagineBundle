<?php

namespace Liip\RokkaImagineBundle\Factory\Rokka\Client;

use Rokka\Client\Base as BaseClient;
use Rokka\Client\TemplateHelper;
use Rokka\Client\TemplateHelper\AbstractCallbacks;

class TemplateHelperFactory
{
    public function create(
        $organization,
        $apiKey,
        AbstractCallbacks $callbacks = null,
        $publicRokkaDomain = null,
        $rokkaApiHost = BaseClient::DEFAULT_API_BASE_URL)
    {
        return new TemplateHelper($organization, $apiKey, $callbacks, $publicRokkaDomain, $rokkaApiHost);
    }
}
