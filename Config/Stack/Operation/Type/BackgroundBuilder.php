<?php

namespace Liip\RokkaImagineBundle\Config\Stack\Operation\Type;

use Liip\ImagineBundle\Config\Filter\Type\Background;
use Liip\ImagineBundle\Config\FilterInterface;
use Rokka\Client\Core\StackOperation;

class BackgroundBuilder extends BuilderAbstract
{
    protected $filterTypeClassName = Background::class;

    public function build(FilterInterface $filter): StackOperation
    {
        $this->validateFilterType($filter);
        $options = [];

        if (null !== $filter->getSize()->getWidth()) {
            $options['width'] = $filter->getSize()->getWidth();
        }

        if (null !== $filter->getSize()->getHeight()) {
            $options['height'] = $filter->getSize()->getHeight();
        }

        if (null !== $filter->getPosition()) {
            switch ($filter->getPosition()) {
                case 'topleft':
                    $anchor = 'left_top';
                    break;
                case 'top':
                    $anchor = 'center_top';
                    break;
                case 'topright':
                    $anchor = 'right_top';
                    break;
                case 'left':
                    $anchor = 'left_center';
                    break;
                case 'center':
                    $anchor = 'center_center';
                    break;
                case 'right':
                    $anchor = 'right_center';
                    break;
                case 'bottomleft':
                    $anchor = 'left_bottom';
                    break;
                case 'bottom':
                    $anchor = 'center_bottom';
                    break;
                case 'bottomright':
                    $anchor = 'right_bottom';
                    break;
                default:
                    throw new \Exception(sprintf(
                        "Unrecognized position value provided: '%s'", $filter->getPosition()
                    ));
            }
            $options['anchor'] = $anchor;
        }

        if (null !== $filter->getTransparency()) {
            $options['secondary_opacity'] = $filter->getTransparency();
        }

        if (null !== $filter->getColor()) {
            $options['secondary_color'] = $this->sanitizeHexColorNoHash($filter->getColor());
        }

        return $this->stackOperationFactory->create('composition', $options);
    }

    /**
     * @param string $color
     * @return null|string
     */
    private function sanitizeHexColorNoHash($color)
    {
        $color = ltrim($color, '#');

        if ('' === $color) {
            return '';
        }

        return $this->sanitizeHexColor('#' . $color ) ? $color : null;
    }

    /**
     * @param string $color
     * @return string
     */
    private function sanitizeHexColor($color)
    {
        if ('' === $color) {
            return '';
        }

        if (preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color)) {
            return $color;
        }
    }
}
