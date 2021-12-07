<?php
declare(strict_types=1);

namespace dmitridad\oksm;

use PHPUnit\Framework\TestCase;

class OKSMTest extends TestCase
{
    public function testGetInstance()
    {
        $oksm = OKSM::getInstance();
        $oksm2 = OKSM::getInstance();

        self::assertInstanceOf(\dmitridad\oksm\contracts\OKSM::class, $oksm);
        self::assertEquals($oksm, $oksm2);
    }
}
