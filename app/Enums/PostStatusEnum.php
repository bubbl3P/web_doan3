<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PostStatusEnum extends Enum
{
    public const PENDING = 0;
    public const ADMIN_APPROVED = 2;

    public static function getByRole(): int
    {
        if(isAdmin()){
            return self::ADMIN_APPROVED;
        }
        return self::PENDING;
    }
}
