<?php


namespace App\Handlers;


use App\Message as MessageDB;
use Illuminate\Support\Facades\App;
use Zetgram\ApiAbstract;
use Zetgram\Handlers\MessageHandler;
use Zetgram\Types\Message;

class PrivateChatHandler extends MessageHandler
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
        if ( isset($message->forwardFromChat) ) {
            $this->api->sendMessage($message->chat->id, trans('foward_other_people_s_message'));
            return;
        }

        if ( isset($message->forwardFrom) && $message->forwardFrom->id !== $message->from->id ) {
            $this->api->sendMessage($message->chat->id, trans('foward_other_people_s_message'));
            return;
        }

        $mes = $this->api->forwardMessage(getenv('ADMIN_CHAT'), $message->chat->id, false, $message->messageId);
        MessageDB::add($message->chat->id, getenv('ADMIN_CHAT') . '_' . $mes->message_id);
    }
}
