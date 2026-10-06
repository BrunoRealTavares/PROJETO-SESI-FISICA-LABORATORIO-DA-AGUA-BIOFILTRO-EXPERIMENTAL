<?php

namespace App\Model;

class Indicadores
{
    
    public static function classificarPh(float $ph): string
    {
        return match (true) {
            $ph >= 6.0 && $ph <= 9.5 => 'Potável',
            $ph < 6.0 => 'Ácido (Inadequado)',
            default => 'Alcalino (Inadequado)'
        };
    }

    public static function classificarTurbidez(float $turbidez): string
    {
        return match (true) {
            $turbidez <= 5.0 => 'Potável',
            default => 'Elevada (Inadequado)'
        };
    }

    public static function classificarCloro(float $cloro): string
    {
        return match (true) {
            $cloro >= 0.2 && $cloro <= 5.0 => 'Potável',
            $cloro < 0.2 => 'Insuficiente (Inadequado)',
            default => 'Excessivo (Inadequado)'
        };
    }

    public function analisarAmostraCompleta(AmostraAgua $amostra): array
    {
        $statusPh = self::classificarPh($amostra->ph);
        $statusTurbidez = self::classificarTurbidez($amostra->turbidez);
        $statusCloro = self::classificarCloro($amostra->cloroResidual);

        $potavel = ($statusPh === 'Potável') && ($statusTurbidez === 'Potável') && ($statusCloro === 'Potável');

        return [
            'ph' => ['valor' => $amostra->ph, 'status' => $statusPh],
            'turbidez' => ['valor' => $amostra->turbidez, 'status' => $statusTurbidez],
            'cloro' => ['valor' => $amostra->cloroResidual, 'status' => $statusCloro],
            'parecerFinal' => $potavel ? 'Água Potável' : 'Água Não Potável'
        ];
    }
}