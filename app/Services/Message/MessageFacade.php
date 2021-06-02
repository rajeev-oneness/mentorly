<?php

namespace App\Services\Message;

use Illuminate\Support\Facades\Facade;

class MessageFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
       return 'message';
    }
}
