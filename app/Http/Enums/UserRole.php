<?php

namespace App\Http\Enums;

final class UserRole
{
    public const ROLE_SUPER_ADMIN = 1;
    public const ROLE_ADMIN = 2;
    public const ROLE_USER = 3;
    public const ROLE_GUEST = 4;
    public const ROLE_CUSTOMER = 5;
    public const ROLE_SUPPLIER = 6;

    public const ROLES = [
        self::ROLE_SUPER_ADMIN => "SUPER_ADMIN",
        self::ROLE_ADMIN => "admin",
        self::ROLE_USER => "user",
        self::ROLE_GUEST => "guest",
        self::ROLE_CUSTOMER => "CUSTOMER",
        self::ROLE_SUPPLIER => "SUPPLIER",
    ];

    public static function of(int $roleId): string
    {
        return self::ROLES[$roleId];
    }
}
