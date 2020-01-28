<?php

namespace Liip\RokkaImagineBundle\Tests\Unit\Imagine\Rokka;

use Imagine\Image\BoxInterface;
use Imagine\Image\Palette\Color\ColorInterface;
use Liip\RokkaImagineBundle\Exception\Imagine\NotImplementedException;
use Liip\RokkaImagineBundle\Imagine\Rokka\Imagine;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ImagineTest extends TestCase
{
    /**
     * @var Imagine
     */
    private $model;

    protected function setUp(): void
    {
        $this->model = new Imagine();
    }

    public function testCreateExpectsNotImplementedException(): void
    {
        $this->expectException(NotImplementedException::class);

        /** @var BoxInterface&MockObject $boxMock */
        $boxMock = $this->createMock(BoxInterface::class);
        $this->model->create($boxMock);
    }

    public function testOpenExpectsNotImplementedException(): void
    {
        $this->expectException(NotImplementedException::class);
        $this->model->open('path');
    }

    public function testLoadExpectsNotImplementedException(): void
    {
        $this->expectException(NotImplementedException::class);
        $this->model->load('string');
    }

    public function testReadExpectsNotImplementedException(): void
    {
        $this->expectException(NotImplementedException::class);
        $this->model->read('resource');
    }

    public function testFontExpectsNotImplementedException(): void
    {
        $this->expectException(NotImplementedException::class);

        /** @var ColorInterface&MockObject $colorMock */
        $colorMock = $this->createMock(ColorInterface::class);
        $this->model->font('', '', $colorMock);
    }
}
