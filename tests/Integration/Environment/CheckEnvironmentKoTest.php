<?php
declare(strict_types=1);

namespace Tests\Integration\Environment;

use BernardoSecades\SmokeTesting\Environment\CheckEnvironment;
use Exception;

class CheckEnvironmentKoTest extends CheckEnvironment
{
    /**
     * {@inheritdoc}
     */
    public function getEnvPath(): string
    {
        return __DIR__ . '/.env.dist';
    }

    public function testCheck(): void
    {
        try {
            parent::testCheck();
            $this->fail('this message should not be seen');
        } catch (Exception $e) {
            $this->assertEquals('Environment variable "DB_CONNECTION" does not exist', $e->getMessage());
        }
    }
}
