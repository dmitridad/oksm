<?php
declare(strict_types=1);

use dmitridad\oksm\OKSM;
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

    public function testIsCodeValid()
    {
        self::assertTrue(OKSM::getInstance()->isCodeValid('051'));
        self::assertTrue(OKSM::getInstance()->isCodeValid('643'));
        self::assertFalse(OKSM::getInstance()->isCodeValid('51'));
        self::assertFalse(OKSM::getInstance()->isCodeValid('999'));
    }

    public function testGetCountries()
    {
        $countries = OKSM::getInstance()->getCountries();

        self::assertIsArray($countries);

        foreach ($countries as $code => $country) {
            self::assertNotEmpty($code);
            self::assertNotNull($code);
        }
    }
}
