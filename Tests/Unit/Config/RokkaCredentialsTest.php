<?php

namespace Liip\RokkaImagineBundle\Tests\Unit\Config;

use Liip\RokkaImagineBundle\Config\RokkaCredentials;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class RokkaCredentialsTest extends TestCase
{
    public function testGetOrganization()
    {
        $returnValue = 'organization_name';

        /** @var ContainerInterface|\PHPUnit_Framework_MockObject_MockObject $containerMock */
        $containerMock = $this->createMock(ContainerInterface::class);
        $containerMock->expects($this->once())
            ->method('getParameter')
            ->with('liip_rokka_imagine.rokka.organization')
            ->will($this->returnValue($returnValue));

        $model = new RokkaCredentials($containerMock);

        $this->assertEquals($returnValue, $model->getOrganization());
    }

    public function testGetApiKey()
    {
        $returnValue = 'api_key';

        /** @var ContainerInterface|\PHPUnit_Framework_MockObject_MockObject $containerMock */
        $containerMock = $this->createMock(ContainerInterface::class);
        $containerMock->expects($this->once())
            ->method('getParameter')
            ->with('liip_rokka_imagine.rokka.api_key')
            ->will($this->returnValue($returnValue));

        $model = new RokkaCredentials($containerMock);

        $this->assertEquals($returnValue, $model->getApiKey());
    }
}
