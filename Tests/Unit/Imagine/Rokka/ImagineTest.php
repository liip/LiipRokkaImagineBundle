<?php

namespace Liip\RokkaImagineBundle\Tests\Unit\Imagine\Rokka;

use Imagine\Image\BoxInterface;
use Imagine\Image\Palette\Color\ColorInterface;
use Liip\RokkaImagineBundle\Exception\Imagine\NotImplementedException;
use Liip\RokkaImagineBundle\Imagine\Rokka\Imagine;
use PHPUnit\Framework\TestCase;

class ImagineTest extends TestCase
{
    /**
     * @var Imagine
     */
    private $model;

    protected function setUp()
    {
        $this->model = new Imagine();
    }

    public function testCreateExpectsNotImplementedException()
    {
        $this->expectException(NotImplementedException::class);

        /** @var BoxInterface|\PHPUnit_Framework_MockObject_MockObject $boxMock */
        $boxMock = $this->createMock(BoxInterface::class);
        $this->model->create($boxMock);
    }

    public function testOpenExpectsNotImplementedException()
    {
        $this->expectException(NotImplementedException::class);
        $this->model->open('path');
    }

    public function testLoadExpectsNotImplementedException()
    {
        $this->expectException(NotImplementedException::class);
        $this->model->load('string');
    }

    public function testReadExpectsNotImplementedException()
    {
        $this->expectException(NotImplementedException::class);
        $this->model->read('resource');
    }

    public function testFontExpectsNotImplementedException()
    {
        $this->expectException(NotImplementedException::class);

        /** @var ColorInterface|\PHPUnit_Framework_MockObject_MockObject $colorMock */
        $colorMock = $this->createMock(ColorInterface::class);
        $this->model->font('', '', $colorMock);
    }
}
