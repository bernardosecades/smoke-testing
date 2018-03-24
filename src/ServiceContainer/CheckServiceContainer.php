<?php
declare(strict_types=1);

namespace BernardoSecades\SmokeTesting\ServiceContainer;

use BernardoSecades\SmokeTesting\SmokeTesting;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Throwable;

abstract class CheckServiceContainer extends TestCase implements SmokeTesting
{
    /**
     * @return ContainerInterface
     */
    abstract protected function getContainer(): ContainerInterface;

    /**
     * @return array
     */
    abstract protected function getAllServiceNames(): array;

    /**
     * {@inheritdoc}
     */
    public function testCheck(): void
    {
        $serviceNames = $this->getAllServiceNames();
        foreach ($serviceNames as $serviceName) {
            try {
                $this->getContainer()->get($serviceName);
            } catch (Throwable $exception) {
                $this->fail(
                    sprintf('Can not get service "%s" from Container. Error: %s',
                        $serviceName,
                        $exception->getMessage()
                    )
                );
            }
        }

        $this->assertTrue(true);
    }
}
