<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Model\AmostraAgua;
use InvalidArgumentException;

class AmostraAguaTest extends TestCase
{
    public function testAmostraValidaCriadaComSucesso(): void
    {
        $amostra = new AmostraAgua(7.0, 2.5, 1.5, 100.0, 25.0);
        $this->assertEquals(7.0, $amostra->ph);
    }

    public function testExcecaoParaPhInvalido(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new AmostraAgua(15.0, 2.5, 1.5, 100.0, 25.0);
    }

    public function testExcecaoParaTurbidezNegativa(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new AmostraAgua(7.0, -1.0, 1.5, 100.0, 25.0);
    }
}