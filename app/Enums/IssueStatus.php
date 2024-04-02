<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;

enum IssueStatus: string implements HasColor
{
    case Pending = 'Pending';
    case Progress = 'In Progress';
    case Fixed = 'Fixed';
    case Deferred = 'Deferred';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Pending => 'gray',
            self::Progress => 'warning',
            self::Fixed => 'success',
            self::Deferred => 'danger',
        };
    }
}
