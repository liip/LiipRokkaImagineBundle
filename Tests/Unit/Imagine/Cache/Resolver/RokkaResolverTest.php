<?php

namespace Liip\RokkaImagineBundle\Tests\Unit\Imagine\Cache\Resolver;

use Liip\ImagineBundle\Binary\BinaryInterface;
use Liip\RokkaImagineBundle\Config\BundleConfig;
use Liip\RokkaImagineBundle\Config\RokkaCredentials;
use Liip\RokkaImagineBundle\Exception\Imagine\NotImplementedException;
use Liip\RokkaImagineBundle\Factory\Rokka\Client\TemplateHelperFactory;
use Liip\RokkaImagineBundle\Imagine\Cache\Resolver\RokkaResolver;
use PHPUnit\Framework\TestCase;
use Rokka\Client\TemplateHelper;

class RokkaResolverTest extends TestCase
{
    /**
     * @var TemplateHelperFactory|\PHPUnit_Framework_MockObject_MockObject
     */
    private $templateHelperFactoryMock;

    /**
     * @var RokkaCredentials|\PHPUnit_Framework_MockObject_MockObject
     */
    private $rokkaCredentialsMock;

    /**
     * @var BundleConfig|\PHPUnit_Framework_MockObject_MockObject
     */
    private $bundleConfigMock;

    /**
     * @var RokkaResolver
     */
    private $model;

    protected function setUp()
    {
        $this->templateHelperFactoryMock = $this->createMock(TemplateHelperFactory::class);
        $this->rokkaCredentialsMock = $this->createMock(RokkaCredentials::class);
        $this->bundleConfigMock = $this->createMock(BundleConfig::class);

        $this->model = new RokkaResolver(
            $this->templateHelperFactoryMock,
            $this->rokkaCredentialsMock,
            $this->bundleConfigMock
        );
    }

    public function testIsStored()
    {
        $this->assertTrue($this->model->isStored('any', 'any'));
    }

    /**
     * @param array $initialData
     * @param string $expected
     *
     * @dataProvider getResolveDataProvider
     */
    public function testResolve(array $initialData, string $expected)
    {
        $imageDirectory = $initialData['img_dir'];
        $organization = $initialData['organization'];
        $apiKey = $initialData['api_key'];
        $filePath = $initialData['file_path'];
        $filter = $initialData['filter'];

        $this->bundleConfigMock->expects($this->once())
            ->method('getImagesDirectory')
            ->will($this->returnValue($imageDirectory));

        $this->rokkaCredentialsMock->expects($this->once())
            ->method('getOrganization')
            ->will($this->returnValue($organization));
        $this->rokkaCredentialsMock->expects($this->once())
            ->method('getApiKey')
            ->will($this->returnValue($apiKey));

        $templateHelperMock = $this->createMock(TemplateHelper::class);
        $templateHelperMock->expects($this->once())
            ->method('getStackUrl')
            ->with($imageDirectory . $filePath, $filter, pathinfo($filePath, PATHINFO_EXTENSION))
            ->will($this->returnValue('http://example.com/' . $filter . $imageDirectory . $filePath));

        $this->templateHelperFactoryMock->expects($this->once())
            ->method('create')
            ->with($organization, $apiKey)
            ->will($this->returnValue($templateHelperMock));

        $this->assertEquals($expected, $this->model->resolve($filePath, $filter));
    }

    public function testStoreExpectsNotImplementedException()
    {
        $this->expectException(NotImplementedException::class);

        /** @var BinaryInterface|\PHPUnit_Framework_MockObject_MockObject $binaryMock */
        $binaryMock = $this->createMock(BinaryInterface::class);
        $this->model->store($binaryMock, 'any_path', 'any_filter');
    }

    public function testRemoveExpectsNotImplementedException()
    {
        $this->expectException(NotImplementedException::class);
        $this->model->remove([], []);
    }

    public function getResolveDataProvider(): array
    {
        return [
            [
                '$initialData' => [
                    'img_dir' => '/test_1/media/images/',
                    'organization' => 'liip_1',
                    'api_key' => 'api_key_1',
                    'file_path' => 'path/to/image.jpg',
                    'filter' => 'thumbnail_1',
                ],
                '$expected' => 'http://example.com/thumbnail_1/test_1/media/images/path/to/image.jpg',
            ],
            [
                '$initialData' => [
                    'img_dir' => '/test_2/media/images/',
                    'organization' => 'liip_2',
                    'api_key' => 'api_key_2',
                    'file_path' => 'path/to/image.png',
                    'filter' => 'thumbnail_2',
                ],
                '$expected' => 'http://example.com/thumbnail_2/test_2/media/images/path/to/image.png',
            ],
        ];
    }
}
