<?php

namespace App;

class Message
{
    public static function add($user_id, $message_id)
    {
        $db = DB::getConnection();
        $stmt = $db->prepare('INSERT INTO message (user_id, message_id) VALUES (?, ?)');
        $stmt->execute([$user_id, $message_id]);
    }

    public static function get(string $message_id) :array
    {
        $db = DB::getConnection();
        $stmt = $db->prepare('SELECT * FROM message WHERE message_id = ?');
        $stmt->execute([$message_id]);
        return $stmt->fetch();
    }

    public static function getUser(string $message_id)
    {
        $db = DB::getConnection();
        $stmt = $db->prepare('SELECT user_id FROM message WHERE message_id = ?');
        $stmt->execute([$message_id]);
        return $stmt->fetch()['user_id'];
    }
}
