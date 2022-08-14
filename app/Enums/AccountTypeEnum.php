<?php

namespace App\Enums;

use ArchTech\Enums\Options;

enum AccountTypeEnum: string
{
    use Options;

    case SAVINGS = 'savings';
    case CASH = 'cash';
    case CREDIT_CARD = 'credit_card';
    case LEASE = 'lease';
}
