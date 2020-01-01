<?php

namespace App\Filters;

use Zetgram\Filters\FilterInterface;
use Zetgram\Types\Update;

class AdminChatFilter implements FilterInterface
{

    public function check(Update $update, ...$params): bool
    {
        if(!isset($update->message))
            return false;

        return $update->message->chat->id === (int)getenv('ADMIN_CHAT');
    }
}