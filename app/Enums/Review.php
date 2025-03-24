<?php

namespace App\Enums;

use Illuminate\Validation\Rules\Enum;

final class Review extends Enum
{
    const EXCELLENT = '1';
    const GOOD = '2';
    const AVERAGE = '3';
    const POOR = '4';
}
