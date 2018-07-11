<?php

namespace Liip\RokkaImagineBundle\Tests\Unit\Config;

use Liip\RokkaImagineBundle\Config\BundleConfig;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BundleConfigTest extends TestCase
{
    public function testGetImagesDirectory()
    {
        $returnValue = '/path/to/images';

        /** @var ContainerInterface|\PHPUnit_Framework_MockObject_MockObject $containerMock */
        $containerMock = $this->createMock(ContainerInterface::class);
        $containerMock->expects($this->once())
            ->method('getParameter')
            ->with('liip_rokka_imagine.images_dir')
            ->will($this->returnValue($returnValue));

        $model = new BundleConfig($containerMock);

        $this->assertEquals($returnValue, $model->getImagesDirectory());
    }
}
