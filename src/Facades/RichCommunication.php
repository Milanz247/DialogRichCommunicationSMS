<?php

namespace YourVendor\RichCommunication\Facades;

use Illuminate\Support\Facades\Facade;

class RichCommunication extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'richcommunication';
    }
}
