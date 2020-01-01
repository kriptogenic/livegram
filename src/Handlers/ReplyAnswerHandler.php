<?php


namespace App\Handlers;


use Zetgram\ApiAbstract;
use Zetgram\Handlers\MessageHandler;
use Zetgram\Types\Message;

class ReplyAnswerHandler extends MessageHandler
{
    /**
     * @var ApiAbstract
     */
    private ApiAbstract $api;

    public function __construct(ApiAbstract $api)
    {
        $this->api = $api;
    }

    public function handleMessage(Message $message)
    {
        $user = \App\Message::getUser(getenv('ADMIN_CHAT') . '_' . $message->replyToMessage->messageId);
        if( !is_numeric($user) ) {
            $this->api->sendMessage($message->chat->id, trans('message_not_delivered'));
            return;
        }

        if (isset($message->text)) {
            $text = $message->text;
            if(isset($message->entities))
                $text = entityToHtml($message->text, $message->entities);
            $this->api->sendMessage($user, $text);
            return;
        }
    }
}