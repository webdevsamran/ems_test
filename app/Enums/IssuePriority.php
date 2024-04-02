<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;

enum IssuePriority: string implements HasColor
{
    case Low = 'Low';
    case Medium = 'Medium';
    case High = 'High';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Low => 'gray',
            self::Medium => 'warning',
            self::High => 'danger',
        };
    }
}
