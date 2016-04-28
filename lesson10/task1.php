<?php
header('content-type:text/html; charset=utf-8');
// Створення нового користувача бази данних з усіма правами
//CREATE USER 'veriga'@'localhost' IDENTIFIED BY  '***';
// GRANT ALL PRIVILEGES ON * . * TO  'veriga'@'localhost'
// IDENTIFIED BY  '***' WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0
// MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;

$user = 'veriga';
$pass = 'gfhjkm';

$dsn = 'mysql:dbname=test_db;host=127.0.0.1';

try {
    $db = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}
// функція створення таблиці
function createTable ($name, $query, $db)
{
    queryMysqli("CREATE TABLE IF NOT EXISTS $name($query)", $db);
    echo "Таблиця '$name' створена або уже існувала<br />";
}

//функція виконання запиту до бази данних
function queryMysqli($query, $db)
{
    $result = $db->query($query) or die('k,');
    return $result;
}

createTable('sample_table',
    'id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(40),
    lastname VARCHAR(40),
    age INT,
    city VARCHAR(40)',
    $db
);
if (isset($_GET['userid'])) {
    $id = (int)$db->real_escape_string($_GET['userid']);


    if (is_int($id)) {
        $data = $db->query("SELECT firstname, lastname FROM sample_table
                  WHERE id=" . $_GET['userid']);
        $row = $data->fetch_assoc();
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        echo $firstname . ' ' . $lastname;
        echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>";
        echo "<input type='hidden' name='id' value='" . $id . "'>";
        echo <<<END
    <label for="age">Вік </label>
    <input type="text" name="age" id="age" />
    <label for="city"> Місто </label>
    <input type="text" name="city" id="city" /> <br />
    <input type="submit" name="submit" value="Зберегти дані">
    </form>
END;
    }
}
if (isset($_POST['age']) && isset($_POST['city']))
{
    $age = $db->real_escape_string($_POST['age']);
    $city = $db->real_escape_string($_POST['city']);
    $id = $db->real_escape_string($_POST['id']);

    queryMysqli("UPDATE sample_table SET age=".$age.", city='". $city ."' WHERE id=". $id . ";", $db);
    echo 'Дані успішно змінено';
}