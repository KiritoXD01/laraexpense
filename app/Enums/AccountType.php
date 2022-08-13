<?php

namespace App\Enums;

enum AccountType: string
{
    case SAVINGS = "savings";
    case CASH = "cash";
    case CREDIT_CARD = "credit_card";
    case LEASE = "lease";
}
