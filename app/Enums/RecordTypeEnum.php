<?php

namespace App\Enums;

use ArchTech\Enums\Options;

enum RecordTypeEnum: string
{
    use Options;

    case EXPENSE = "expense";
    case INCOME = 'income';
    case TRANSFER = 'transfer';
}
