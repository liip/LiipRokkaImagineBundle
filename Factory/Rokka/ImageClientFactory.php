<?php

namespace Liip\RokkaImagineBundle\Factory\Rokka;

use Rokka\Client\Base as BaseClient;
use Rokka\Client\Image as ImageClient;

class ImageClientFactory
{
    public function create(
        string $organization,
        string $apiKey,
        string $baseUrl = BaseClient::DEFAULT_API_BASE_URL
    ): ImageClient {
        return \Rokka\Client\Factory::getImageClient($organization, $apiKey, $baseUrl);
    }
}
