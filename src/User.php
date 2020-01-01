<?php

namespace App;

class User
{
    public static function add(int $id)
    {
        $db = DB::getConnection();
        $stmt = $db->prepare('INSERT OR IGNORE INTO user (id) VALUES (?)');
        $stmt->execute([$id]);
    }
}
