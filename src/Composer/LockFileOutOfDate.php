<?php
declare(strict_types=1);

namespace BernardoSecades\SmokeTesting\Composer;

use BernardoSecades\SmokeTesting\SmokeTesting;
use PHPUnit\Framework\TestCase;
use Composer\Package\Locker;

abstract class LockFileOutOfDate extends TestCase implements SmokeTesting
{
    /**
     * @return string
     */
    abstract protected function getProjectPath(): string;

    /**
     * {@inheritdoc}
     */
    public function testCheck(): void
    {
        $composerFilePath = $this->getProjectPath() . DIRECTORY_SEPARATOR . 'composer.json';
        $composerLockFilePath = $this->getProjectPath() . DIRECTORY_SEPARATOR . 'composer.lock';

        $contentComposerLock = json_decode(file_get_contents($composerLockFilePath), true);
        $hashComposerLockFile = $contentComposerLock['content-hash'];
        $hashComposerFile = Locker::getContentHash(file_get_contents($composerFilePath));

        if ($hashComposerLockFile !== $hashComposerFile) {
            $this->fail('Lock file up to date');
        }

        $this->assertTrue(true);
    }
}
