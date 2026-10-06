<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Model\Biofiltro;
use DivisionByZeroError;

class BiofiltroTest extends TestCase
{
    public function testCalculoEficienciaComValoresConhecidos(): void
    {
        $biofiltro = new Biofiltro();
        // Entrada: 20.0 NTU -> Saída: 4.0 NTU (Remoção de 16 NTU = 80%)
        $eficiencia = $biofiltro->calcularEficienciaRemocao(20.0, 4.0);
        $this->assertEquals(80.0, $eficiencia);
    }

    public function testExcecaoDivisaoPorZeroAoCalcularEficiencia(): void
    {
        $biofiltro = new Biofiltro();
        $this->expectException(DivisionByZeroError::class);
        $biofiltro->calcularEficienciaRemocao(0.0, 0.0);
    }
}