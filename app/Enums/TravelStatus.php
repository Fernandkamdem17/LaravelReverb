<?php

namespace App\Enums;

enum TravelStatus: int
{
    case Pending = 0;
    case Accepted = 1;
    case InProgress = 2;
    case Completed = 3;
    case Cancelled = 4;
}
