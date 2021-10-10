<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use BADDIServices\ClnkGO\Common\Traits\User as UserTrait;
use BADDIServices\ClnkGO\Models\Authenticatable;

class User extends Authenticatable
{
    use UserTrait, Notifiable;
}
