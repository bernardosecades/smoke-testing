<?php
declare(strict_types=1);

namespace Tests\Integration\Environment;

use BernardoSecades\SmokeTesting\Composer\LockFileOutOfDate;

class LockFileOutOfDateTestOk extends LockFileOutOfDate
{
    /**
     * {@inheritdoc}
     */
    protected function getProjectPath(): string
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'json_files_ok';
    }
}
