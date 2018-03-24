<?php
declare(strict_types=1);

namespace Tests\Unit\ServiceContainer;

use BernardoSecades\SmokeTesting\ServiceContainer\CheckServiceContainer;
use Prophecy\Prophecy\ObjectProphecy;
use Psr\Container\ContainerInterface;

class CheckServiceContainerOkTest extends CheckServiceContainer
{
    /** @var  ObjectProphecy */
    private $containerPro;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->containerPro = $this->prophesize(ContainerInterface::class);
    }

    /**
     * {@inheritdoc}
     */
    protected function getContainer(): ContainerInterface
    {
        return $this->containerPro->reveal();
    }

    /**
     * {@inheritdoc}
     */
    protected function getAllServiceNames(): array
    {
        return [
            'ServiceName1',
        ];
    }
}
