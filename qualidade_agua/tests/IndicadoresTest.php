<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Model\Indicadores;
use App\Model\AmostraAgua;

class IndicadoresTest extends TestCase
{
    public function testClassificacaoPhPotavel(): void
    {
        $this->assertEquals('Potável', Indicadores::classificarPh(7.0));
    }

    public function testClassificacaoPhAcido(): void
    {
        $this->assertEquals('Ácido (Inadequado)', Indicadores::classificarPh(5.5));
    }

    public function testClassificacaoTurbidezPotavel(): void
    {
        $this->assertEquals('Potável', Indicadores::classificarTurbidez(2.0));
    }

    public function testClassificacaoCloroInsuficiente(): void
    {
        $this->assertEquals('Insuficiente (Inadequado)', Indicadores::classificarCloro(0.1));
    }

    public function testAnalisarAmostraCompletaPotavel(): void
    {
        $amostra = new AmostraAgua(7.0, 2.5, 1.5, 100.0, 25.0);
        $indicadores = new Indicadores();

        $resultado = $indicadores->analisarAmostraCompleta($amostra);

        $this->assertEquals('Água Potável', $resultado['parecerFinal']);
        $this->assertEquals('Potável', $resultado['ph']['status']);
        $this->assertEquals('Potável', $resultado['turbidez']['status']);
        $this->assertEquals('Potável', $resultado['cloro']['status']);
    }
}