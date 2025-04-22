<?php

namespace App\Enums;

use Illuminate\Validation\Rules\Enum;

final class Roles extends Enum
{
    const SUPERADMNIN = '1';
    const ADMIN = '2';
    const SHOWROOM = '3';
}
