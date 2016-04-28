<?php
header('content-type: text/html; charset=utf-8');
session_start();

$user = 'veriga';
$pass = 'gfhjkm';

$dsn = 'mysql:dbname=test_db;host=127.0.0.1';

try {
    $db = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}
// якщо уже проходили і є куки
if  (isset($_COOKIE['counter']) && isset($_COOKIE['answer']))
{
    $_SESSION['counter'] = $_COOKIE['counter'];
    $_SESSION['answer'] = unserialize($_COOKIE['answer']);
    $_SESSION['id'] = $_COOKIE['id'];
}

// якщо тест не розпочато. форма старту
if (!isset($_SESSION['new_test']) && !$_SESSION['exit']
    && !isset($_COOKIE['counter']) && !$_POST['new_test'])
{
    echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST">';
    echo '<input type="submit" name="new_test" value="Розпочати тест">';
    echo '</form>';
}


    //тест розпочато
if (isset($_POST['new_test']) && !$_SESSION['new_test'])
    {
        // дістаєм id питань
        $data = $db->query("SELECT id FROM questions") or die('Помилка вибірки');
        foreach ($data as $value) {
            $index_question[] = $value['id'];
        }
        shuffle($index_question);

        $db->query("INSERT INTO result(id, true_answer) VALUE (NULL, 0)")
                    or die('Помилка початку тесту');
        $_SESSION['id'] = $db->LastInsertId();
        $_SESSION['index_question'] = $index_question;
        $_SESSION['new_test'] = true;
        $_SESSION['counter'] = 0;
        $_SESSION['exit'] = false;
        $_POST['next'] = true;
    }

// натиснуто кнопку далі
if (isset($_POST['next']) && !$_SESSION['exit'])
{
    // індекс питання, вибрано зі змішаного масиву
    $index_question = $_SESSION['index_question'][$_SESSION['counter']];
    // відповідь до  питання з індексом
    //тут перевіряємо якщо користувач любить оновлювати сторінку
    // то не приймати оновлення сторіки як відповідь
    // відповідь приймається тільки тоді коли натиснута кнопка далі
    if ($index_question == $_POST['counter'])
    {
        if ($_POST['question_tru'] == $_POST[$index_question])
        $db->query("UPDATE result SET true_answer = true_answer + 1 WHERE id=" . $_SESSION['id'] . ";")
                    or die('Помилка створення запису результатів тесту');
        $_SESSION['counter']++;
    }
}


if($_SESSION['counter'] > 4)
{
    if  (!(!isset($_COOKIE['counter']) && !isset($_COOKIE['answer'])))
    {
        setcookie('counter', $_SESSION['counter'], time() + 60 * 60 * 24 * 7);
        setcookie('answer', serialize($_SESSION['answer']), time() + 60 * 60 * 24 * 7);
        setcookie('id', $_SESSION['id'], time() + 60 * 60 * 24 * 7);
    }
    $_SESSION['exit'] = true;
    $data = $db->query("SELECT true_answer FROM result WHERE id=" . $_SESSION['id'].";")
            or die('Помилка зчитування результату');
    $array_true = $data->fetch();
    $true = $array_true['true_answer'];
    echo 'Вітаю, ви пройшли тест!<br>';
    echo 'Правильних відповідей - ' . $true . '<br>';
    echo 'Неправильних відповідей - ' . (5 - $true) . '<br>';
    echo 'Набрано зі 100 балів - ' . ($true)/count($_SESSION['index_question'])*100 . '<br>';
}
//  тест розпочато і ще не завершено
if ((!$_SESSION['exit'] && $_SESSION['new_test']))
{
    // індекс питання, вибрано зі змішаного масиву
    $index_question = $_SESSION['index_question'][$_SESSION['counter']];
    $array_variant = array();
    // масив варіантів
    $data = $db->query("SELECT v.id, v.answer
                        FROM variant v INNER JOIN questions q
                        ON v.id_question = q.id WHERE q.id =" . $index_question . ";")
    or die('Помилка зчитування варіантів запитань');
    $result = $data->fetchALL();
    foreach ($result as $row)
    {
        $array_variant[] = $row;
    }
    shuffle($array_variant);

    // саме запитання та ід вірного варіанта
    $data = $db->query("SELECT question, tru_id_v FROM questions WHERE id=" .$index_question. ";")
            or die('Помилка зчитування запитання');
    $result = $data->fetch();

    echo '<form action = ' . $_SERVER['PHP_SELF'] . ' method="post">';
    echo '<p><b>' . $result['question'] . '</b></p>';
    echo '<input type="hidden" name="question_tru" value="' . $result['tru_id_v'] . '">';
    echo '<input type="hidden" name="counter" value="' . $index_question . '">';

    foreach ($array_variant as $variant) {
        $name_v = 'variant' . $variant['id'];
        echo '<input type="radio" name="' . $index_question . '" id="' . $name_v . '" value="'. $variant['id'] .'">';
        echo '<label for="' . $name_v . '">' . $variant['answer'] .'</label><br/>';
    }

    echo '<input type="submit" name="next" value="Далі">';
    echo '</form>';
}

