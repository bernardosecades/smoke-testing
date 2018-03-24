<?php
declare(strict_types=1);

namespace BernardoSecades\SmokeTesting\Environment;

use BernardoSecades\SmokeTesting\SmokeTesting;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Dotenv\Dotenv;

abstract class CheckEnvironment extends TestCase implements SmokeTesting
{
    /**
     * @return string
     */
    abstract protected function getEnvPath(): string;

    /**
     * {@inheritdoc}
     */
    public function testCheck(): void
    {
        $vars = (new Dotenv())->parse(file_get_contents($this->getEnvPath()), $this->getEnvPath());
        $varNames = array_keys($vars);

        foreach ($varNames as $varName) {
            $value = getenv($varName);
            if (false === $value) {
                $this->fail(sprintf('Environment variable "%s" does not exist', $varName));
            }
            if (!is_numeric($value) && empty($value)) {
                $this->fail(sprintf('Environment variable "%s" is empty', $varName));
            }
        }

        $this->assertTrue(true);
    }
}
