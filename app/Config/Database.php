<?php

namespace todolist\Config;

class Database
{
    private static ?\PDO $pdo = null;

    public static function getConnection(string $env = "test"): \PDO
    {
        if (self::$pdo == null) {
            require_once __DIR__ . "/../../config/database.php";
            $config = getDatabaseConfig();
            self::$pdo = new \PDO(
                $config['database'][$env]["url"],
                $config['database'][$env]["username"],
                $config['database'][$env]["password"]
            );
        }

        return self::$pdo;
    }

    public static function beginTransaction()
    {
        return self::$pdo->beginTransaction();
    }

    public static function commitTransaction()
    {
        return self::$pdo->commit();
    }
    
    public static function rollbackTransaction()
    {
        return self::$pdo->rollBack();
    }
}
