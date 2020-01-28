<?php

namespace Liip\RokkaImagineBundle\Tests\Unit\Config;

use Liip\RokkaImagineBundle\Config\RokkaCredentials;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class RokkaCredentialsTest extends TestCase
{
    public function testGetOrganization(): void
    {
        $returnValue = 'organization_name';

        /** @var ContainerInterface&MockObject $containerMock */
        $containerMock = $this->createMock(ContainerInterface::class);
        $containerMock->expects($this->once())
            ->method('getParameter')
            ->with('liip_rokka_imagine.rokka.organization')
            ->willReturn($returnValue);

        $model = new RokkaCredentials($containerMock);

        $this->assertEquals($returnValue, $model->getOrganization());
    }

    public function testGetApiKey(): void
    {
        $returnValue = 'api_key';

        /** @var ContainerInterface&MockObject $containerMock */
        $containerMock = $this->createMock(ContainerInterface::class);
        $containerMock->expects($this->once())
            ->method('getParameter')
            ->with('liip_rokka_imagine.rokka.api_key')
            ->willReturn($returnValue);

        $model = new RokkaCredentials($containerMock);

        $this->assertEquals($returnValue, $model->getApiKey());
    }
}
