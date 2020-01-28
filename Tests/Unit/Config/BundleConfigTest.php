<?php

namespace Liip\RokkaImagineBundle\Tests\Unit\Config;

use Liip\RokkaImagineBundle\Config\BundleConfig;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BundleConfigTest extends TestCase
{
    public function testGetImagesDirectory(): void
    {
        $returnValue = '/path/to/images';

        /** @var ContainerInterface&MockObject $containerMock */
        $containerMock = $this->createMock(ContainerInterface::class);
        $containerMock->expects($this->once())
            ->method('getParameter')
            ->with('liip_rokka_imagine.images_dir')
            ->willReturn($returnValue);

        $model = new BundleConfig($containerMock);

        $this->assertEquals($returnValue, $model->getImagesDirectory());
    }
}
