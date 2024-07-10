<?php

namespace App\Enums;

enum RolesEnum: string
{
    case USER = 'user';
    case ADMIN = 'editor';
    case TOURISMMANAGER = 'tourism-manager';

    // extra helper to allow for greater customization of displayed values, without disclosing the name/value data directly
    public function label(): string
    {
        return match ($this) {
            static::USER => 'Users',
            static::ADMIN => 'Admin',
            static::TOURISMMANAGER => 'Tourism Managers',
        };
    }
}
