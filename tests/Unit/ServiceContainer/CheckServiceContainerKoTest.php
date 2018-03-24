<?php
declare(strict_types=1);

namespace Tests\Unit\ServiceContainer;

use BernardoSecades\SmokeTesting\ServiceContainer\CheckServiceContainer;
use Prophecy\Prophecy\ObjectProphecy;
use Psr\Container\ContainerInterface;
use Exception;

class CheckServiceContainerKoTest extends CheckServiceContainer
{
    private const SERVICE_NAME_1 = 'ServiceName1';

    /** @var  ObjectProphecy */
    private $containerPro;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->containerPro = $this->prophesize(ContainerInterface::class);
        $this->containerPro->get(static::SERVICE_NAME_1)->willThrow(new Exception());
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
            static::SERVICE_NAME_1,
        ];
    }

    public function testCheck(): void
    {
        try {
            parent::testCheck();
            $this->fail('this message should not be seen');
        } catch (Exception $e) {
            $this->assertContains('Can not get service', $e->getMessage());
        }
    }
}
