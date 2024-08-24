<?php

namespace App\Enums;

use App\Enums\Traits\EnumToArray;

enum SMSPanelTypeEnum: int
{
    use EnumToArray;

    case KAVENEGAR = 1;
    case SMSIDEHPARDAZAN = 2;

}
