<?php
require_once 'home_task/functions.php';
header('content-type: text/html; charset=utf-8');
if ((isset($_POST['session']) && $_POST['session'] = 1))
{
    $array = array(
        'id' => $_SESSION['id'],
        'counter' => $_SESSION['counter']++,
        'index_question' => $_SESSION['index_question'],
    );
    echo json_encode($array);
}
