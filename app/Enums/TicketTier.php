<?php

namespace App\Enums;

enum TicketTier: string
{
    case Gold = 'gold';
    case Platinum = 'platinum';
    case Diamond = 'diamond';
}
