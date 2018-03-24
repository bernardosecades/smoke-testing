<?php
declare(strict_types=1);

namespace Tests\Integration\Environment;

use BernardoSecades\SmokeTesting\Environment\CheckEnvironment;
use Symfony\Component\Dotenv\Dotenv;

class CheckEnvironmentOkTest extends CheckEnvironment
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
        (new Dotenv())->load($this->getEnvPath());
        parent::testCheck();
    }
}
