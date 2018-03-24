<?php
declare(strict_types=1);

namespace BernardoSecades\SmokeTesting;

use PHPUnit\Framework\AssertionFailedError;

interface SmokeTesting
{
    /**
     * @return void
     * @throws AssertionFailedError
     */
    public function testCheck(): void;
}
