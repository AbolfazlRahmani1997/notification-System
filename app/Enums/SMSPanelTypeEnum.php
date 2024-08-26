<?php

namespace App\Enums;

use App\Enums\Traits\EnumToArray;

enum SMSPanelTypeEnum: int
{
    use EnumToArray;

    case KAVENEGAR = 1;
    case SMSIDEHPARDAZAN = 2;
    case SMs=3;


    public static function priorityList(): array
    {

        return [self::KAVENEGAR->value, self::SMSIDEHPARDAZAN->value,self::SMs->value];
    }

}
