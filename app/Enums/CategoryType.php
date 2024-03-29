<?php

namespace App\Enums;

enum CategoryType: string {
    case CUENTAS = 'Cuentas';
    case OBJETIVOS = 'Objetivos';
    case TRANSACCIONES = 'Transacciones';
}
