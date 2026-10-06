<?php

namespace App\Controller;

use App\Model\AmostraAgua;
use App\Model\Biofiltro;
use App\Model\Indicadores;

class QualidadeAguaController
{
    private Indicadores $indicadores;
    private Biofiltro $biofiltro;

    public function __construct()
    {
        $this->indicadores = new Indicadores();
        $this->biofiltro = new Biofiltro();
    }

    public function processarAmostraEFiltragem(array $dadosEntrada): array
    {
        $amostraBruta = new AmostraAgua(
            (float) $dadosEntrada['ph'],
            (float) $dadosEntrada['turbidez'],
            (float) $dadosEntrada['cloro'],
            (float) $dadosEntrada['dureza'],
            (float) $dadosEntrada['temperatura']
        );

        $analiseBruta = $this->indicadores->analisarAmostraCompleta($amostraBruta);
        $amostraFiltrada = $this->biofiltro->simularFiltragem($amostraBruta);
        $analiseFiltrada = $this->indicadores->analisarAmostraCompleta($amostraFiltrada);

        $eficienciaTurbidez = $this->biofiltro->calcularEficienciaRemocao(
            $amostraBruta->turbidez,
            $amostraFiltrada->turbidez
        );

        return [
            'antesFiltro' => $analiseBruta,
            'depoisFiltro' => $analiseFiltrada,
            'eficienciaBiofiltro' => $eficienciaTurbidez . '%'
        ];
    }
}