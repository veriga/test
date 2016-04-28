<?php
function connect_sql()
{
    $user = 'veriga';
    $pass = 'gfhjkm';

    $dsn = 'mysql:dbname=test_db;host=127.0.0.1';
    global $db;
    try {

        $db = new PDO($dsn, $user, $pass);
    } catch (PDOException $e) {
        echo 'Подключение не удалось: ' . $e->getMessage();
    }
    $GLOBALS['db'] = $db;
}



