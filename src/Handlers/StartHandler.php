<?php

namespace App\Handlers;

use App\User;
use Zetgram\ApiAbstract;
use Zetgram\Handlers\MessageHandler;
use Zetgram\Types\Message;

class StartHandler extends MessageHandler
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
        $this->api->sendMessage($message->chat->id, trans('welcome'));
        User::add($message->from->id);
    }
}
