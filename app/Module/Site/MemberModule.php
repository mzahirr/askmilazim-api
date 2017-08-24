<?php namespace App\Module\Site;

use App\Base\Module;

class MemberModule extends Module
{
    public function Index()
    {
        return [
            'message' => 'Merhaba Dünya'
        ];
    }
}