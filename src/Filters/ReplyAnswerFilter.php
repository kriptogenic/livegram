<?php


namespace App\Filters;


use Zetgram\Filters\FilterInterface;
use Zetgram\Types\Update;

class ReplyAnswerFilter implements FilterInterface
{

    public function check(Update $update, ...$params): bool
    {
        if(!isset($update->message))
            return false;

        if(!isset($update->message->replyToMessage))
            return false;

        if($update->message->replyToMessage->from->id !== (int)getenv('BOT_ID'))
            return false;

        if(isset($update->message->replyToMessage->forwardFrom))
            return true;

        return isset($update->message->replyToMessage->forwardSenderName);
    }
}