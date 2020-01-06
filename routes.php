<?php

use App\Filters\AdminChatFilter;
use App\Filters\PrivateChatFilter;
use App\Filters\ReplyAnswerFilter;
use App\Handlers\PrivateChatHandler;
use App\Handlers\ReplyAnswerHandler;
use App\Handlers\StartHandler;

$bot->hears('^\/start.*', StartHandler::class);
$bot->addRoute(ReplyAnswerHandler::class, AdminChatFilter::class, ReplyAnswerFilter::class);
$bot->addRoute(PrivateChatHandler::class, PrivateChatFilter::class);

