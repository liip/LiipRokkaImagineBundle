<?php

namespace Liip\RokkaImagineBundle\Imagine\Rokka;

use Imagine\Image\AbstractImagine;
use Imagine\Image\BoxInterface;
use Imagine\Image\Palette\Color\ColorInterface;
use Liip\RokkaImagineBundle\Exception\Imagine\NotImplementedException;

class Imagine extends AbstractImagine
{
    public function create(BoxInterface $size, ColorInterface $color = null)
    {
        throw new NotImplementedException();
    }

    public function open($path)
    {
        throw new NotImplementedException();
    }

    public function load($string)
    {
        throw new NotImplementedException();
    }

    public function read($resource)
    {
        throw new NotImplementedException();
    }

    public function font($file, $size, ColorInterface $color)
    {
        throw new NotImplementedException();
    }
}
