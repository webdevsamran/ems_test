<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;

enum CvStatus: string implements HasColor
{
    case RECEIVED = 'received';
    case SCHEDULED = 'scheduled';
    case INTERVIEWED = 'interviewed';
    case REJECTED = 'rejected';
    case DEFERRED = 'deferred';
    case HIRED = 'hired';
    case INTERN = 'intern';

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::RECEIVED, self::DEFERRED => 'primary',
            self::SCHEDULED => 'info',
            self::INTERVIEWED => 'gray',
            self::REJECTED => 'danger',
            self::HIRED, self::INTERN => 'success',
        };
    }
}
