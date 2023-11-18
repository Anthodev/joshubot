<?php

declare(strict_types=1);

namespace App\Enum;

enum GptRoleEnum: string
{
    case USER = 'user';
    case SYSTEM = 'system';
}
