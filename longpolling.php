<?php
declare(strict_types=1);

use App\Filters\AdminChatFilter;
use App\Filters\PrivateChatFilter;
use App\Filters\ReplyAnswerFilter;
use App\Handlers\PrivateChatHandler;
use App\Handlers\ReplyAnswerHandler;
use App\Handlers\StartHandler;
use Zetgram\Bot;

require __DIR__ . '/boot.php';

/**
 * @var Bot $bot
 */
$bot = $container->get(Bot::class);

$bot->hears('\/start.*', StartHandler::class);
$bot->addRoute(ReplyAnswerHandler::class, AdminChatFilter::class, ReplyAnswerFilter::class);
$bot->addRoute(PrivateChatHandler::class, PrivateChatFilter::class);

$bot->run();
