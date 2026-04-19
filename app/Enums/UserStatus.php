<?php

namespace App\Enums;

enum UserStatus: int
{
    case INACTIVE = 0;
    case ACTIVE = 1;

    /**
     * Get label
     *
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::INACTIVE => trans('response.label.inactive'),
            self::ACTIVE => trans('response.label.active'),
        };
    }
}
