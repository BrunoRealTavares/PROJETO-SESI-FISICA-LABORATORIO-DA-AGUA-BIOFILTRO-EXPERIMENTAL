<?php

namespace App\Model;

use DivisionByZeroError;

class Biofiltro
{
    
    public function calcularEficienciaRemocao(float $valorBruto, float $valorFiltrado): float
    {
        if ($valorBruto == 0.0) {
            throw new DivisionByZeroError("Divisão por zero: O valor inicial (bruto) não pode ser zero para calcular a taxa de remoção.");
        }

        $eficiencia = (($valorBruto - $valorFiltrado) / $valorBruto) * 100;
        return round($eficiencia, 2);
    }

    public function simularFiltragem(AmostraAgua $amostraBruta, float $eficienciaCamadas = 80.0): AmostraAgua
    {
        $novaTurbidez = $amostraBruta->turbidez * (1 - ($eficienciaCamadas / 100));
        
        return new AmostraAgua(
            $amostraBruta->ph,
            round($novaTurbidez, 2),
            $amostraBruta->cloroResidual,
            $amostraBruta->dureza,
            $amostraBruta->temperatura
        );
    }
}