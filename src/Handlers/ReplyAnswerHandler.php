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

        $this->sendAnswer($message, $user);


    }

    private function sendAnswer(Message $message, $user)
    {
        if (isset($message->text)) {
            $text = $message->text;
            if(isset($message->entities))
                $text = entityToHtml($message->text, $message->entities);
            $this->api->sendMessage($user, $text);
            return;
        }

        if (isset($message->sticker)) {
            $this->api->sendSticker($user, $message->sticker->fileId);
            return;
        }

        if (isset($message->contact)) {
            $this->api->sendContact(
                $user,
                $message->contact->phoneNumber,
                $message->contact->firstName,
                $message->contact->lastName ?? null
            );
            return;
        }

        if (isset($message->location)) {
            $this->api->sendLocation($user, $message->location->latitude, $message->location->longitude);
            return;
        }

        if (isset($message->videoNote)) {
            $this->api->sendVideoNote($user, $message->videoNote->fileId);
            return;
        }

        $caption = '';
        if (isset($message->caption)) {
            $caption = entityToHtml($message->caption, $message->captionEntities ?? []);
        }

        if (isset($message->animation)) {
            $this->api->sendAnimation(
                $user, $message->animation->fileId,
                null, null, null, null,
                $caption,
                'HTML'
            );
            return;
        }

        if (isset($message->photo)) {
            $this->api->sendPhoto($user, $message->photo->last()->fileId, $caption, 'HTML');
            return;
        }

        if (isset($message->video)) {
            $this->api->sendVideo(
                $user,
                $message->video->fileId,
                null, null, null, null,
                $caption,
                'HTML'
            );
            return;
        }

        if (isset($message->voice)) {
            $this->api->sendVoice($user, $message->voice->fileId, $caption, 'HTML');
            return;
        }

        if (isset($message->document)) {
            $this->api->sendDocument($user, $message->document->fileId, null, $caption, 'HTML');
            return;
        }
    }
}