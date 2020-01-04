<?php
declare(strict_types=1);

use Zetgram\Bot;

require __DIR__ . '/boot.php';

/**
 * @var Bot $bot
 */
$bot = $container->get(Bot::class);

include APP_DIR . 'routes.php';

$bot->run();
