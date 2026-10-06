<?php

namespace App\Model;

use InvalidArgumentException;

class AmostraAgua
{
    public function __construct(
        public float $ph,
        public float $turbidez,       // em NTU
        public float $cloroResidual,  // em mg/L
        public float $dureza,         // em mg/L CaCO3
        public float $temperatura     // em °C
    ) {
        $this->validarParametros();
    }

    private function validarParametros(): void
    {
        if ($this->ph < 0 || $this->ph > 14) {
            throw new InvalidArgumentException("O valor do pH deve estar entre 0 e 14.");
        }
        if ($this->turbidez < 0) {
            throw new InvalidArgumentException("A turbidez não pode ser um valor negativo.");
        }
        if ($this->cloroResidual < 0) {
            throw new InvalidArgumentException("O cloro residual não pode ser um valor negativo.");
        }
        if ($this->dureza < 0) {
            throw new InvalidArgumentException("A dureza não pode ser um valor negativo.");
        }
        if ($this->temperatura < -50 || $this->temperatura > 100) {
            throw new InvalidArgumentException("A temperatura informada é fisicamente impossível.");
        }
    }
}