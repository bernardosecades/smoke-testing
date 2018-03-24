<?php
declare(strict_types=1);

namespace Tests\Integration\Environment;

use BernardoSecades\SmokeTesting\Composer\LockFileOutOfDate;
use Exception;

class LockFileOutOfDateTestKo extends LockFileOutOfDate
{
    /**
     * {@inheritdoc}
     */
    protected function getProjectPath(): string
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'json_files_ko';
    }

    public function testCheck(): void
    {
        try {
            parent::testCheck();
            $this->fail('this message should not be seen');
        } catch (Exception $e) {
            $this->assertEquals('Lock file up to date', $e->getMessage());
        }
    }
}
