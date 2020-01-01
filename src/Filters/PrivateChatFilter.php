<?php


namespace App\Filters;


use Zetgram\Filters\FilterInterface;
use Zetgram\Types\Update;

class PrivateChatFilter implements FilterInterface
{

    public function check(Update $update, ...$params): bool
    {
        if(!isset($update->message))
            return false;

        return $update->message->chat->type === 'private';
    }
}