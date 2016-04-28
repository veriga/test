<?php
header('content-type: text/html; charset=utf-8');
require_once 'functions.php';
// початок тесту
if($_POST['counter'] == 999)
{
    connect_sql();
    $db = $GLOBALS['db'];
    // дістаєм id питань
    $data = $db->query("SELECT id FROM questions") or die('Помилка вибірки id питань');
    foreach ($data as $value) {
        $index_question[] = $value['id'];
    }
    shuffle($index_question);

    $db->query("INSERT INTO result(id, true_answer) VALUE (NULL, 0)")
    or die('Помилка початку тесту');

    $id = $db->LastInsertId();

    unset($db);
    setcookie('counter', '0', time()+60*60*24);
    setcookie('id', $id, time()+60*60*24);
    setcookie('index_question', json_encode($index_question), time()+60*60*24);
}

if ((isset($_POST['session']) && $_POST['session'] = 1))
{
    $array = array(
        'id' => $_COOKIE['id'],
        'counter' => $_COOKIE['counter'],
        'index_question' => json_decode($_COOKIE['index_question'])
    );
    echo json_encode($array);
}
if (isset($_POST['answer']) && $_POST['answer'] != -1)
{
    setcookie('counter', $_COOKIE['counter'] + 1, time() + 60 * 60 * 24);
    connect_sql();
    $db = $GLOBALS['db']; // конект бази данних
    if ($_POST['counter'] == 0) {  $_POST['counter'] = 1; setcookie('counter', $_COOKIE['counter'] + 2, time() + 60 * 60 * 24);}
    $counter = $_POST['counter'];
    $id = $_POST['id'];
    $index_question = json_decode($_POST['index_question']);
    // індекс питання, вибрано зі змішаного масиву
    $i_question = $index_question[$counter - 1];
    $data = $db->query("SELECT tru_id_v FROM questions WHERE id=" . $i_question . ";")
    or die('Помилка зчитування запитання');
    $result = $data->fetch();
    $tru = $result['tru_id_v'];
    if ($tru == $_POST['answer']) {
        $db->query("UPDATE result SET true_answer = true_answer + 1 WHERE id=" . $id . ";")
        or die('Помилка створення запису результатів тесту');
    }
}

if(isset($_POST['counter']) && isset($_POST['id']) && ($_POST['counter'] < 5))
{
    connect_sql();
        $db = $GLOBALS['db']; // конект бази данних
    if ($counter == 0)

    $counter = $_POST['counter'];
    $id = $_COOKIE['id'];
    $index_question = json_decode($_POST['index_question']);
    // індекс питання, вибрано зі змішаного масиву
    $i_question = $index_question[$counter];
    $array_variant = array();
    // масив варіантів
    $data = $db->query("SELECT v.id, v.answer
                            FROM variant v INNER JOIN questions q
                            ON v.id_question = q.id WHERE q.id =" . $i_question . ";")
    or die('Помилка зчитування варіантів запитань 111111');
    $result = $data->fetchALL();
    foreach ($result as $row) {
        $array_variant[] = $row;
    }
    shuffle($array_variant);

    // саме запитання та ід вірного варіанта
    $data = $db->query("SELECT question FROM questions WHERE id=" . $i_question . ";")
    or die('Помилка зчитування запитання');
    $result = $data->fetch();

    echo '<form>';
    echo '<p><b>' . $result['question'] . '</b></p>';
    echo '<input type="hidden" name="counter" value="' . $i_question . '">';

    foreach ($array_variant as $variant) {
        $name_v = 'variant' . $variant['id'];
        echo '<input type="radio" name="' . $i_question . '" id="' . $name_v . '" value="' . $variant['id'] . '">';
        echo '<label for="' . $name_v . '">' . $variant['answer'] . '</label><br/>';
    }

    echo '<input id="next_button" type="button" name="next" value="Далі" >';
    echo '</form>';

    unset($db);

}

if ($_POST['counter'] > 4)
{
    connect_sql();
    $id = $_COOKIE['id'];
    $db = $GLOBALS['db']; // конект бази данних
    echo "Вітаю! Тест завершено!! <br/>";
    $data = $db->query("SELECT  count(q.question) , r.true_answer
                        FROM result r INNER JOIN questions q WHERE r.id =" . $id . ";")
    or die('Помилка отримання результатів з бази данних');
    $result = $data->fetch();
    $true_answer = $result['true_answer'];
    $answer = $result['count(q.question)'];
    echo 'Вірних відповідей ' . $true_answer . ' з ' . $answer . "<br />";
    echo "Набрано " . (int)($true_answer/$answer*100) . " балів зі 100.";
}
