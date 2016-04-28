<?php
header('content-type: text/html; charset=utf-8');
session_start();
if  (isset($_COOKIE['counter']) && isset($_COOKIE['answer']))
{
    $_SESSION['counter'] = $_COOKIE['counter'];
    $_SESSION['answer'] = unserialize($_COOKIE['answer']);
}
$a_question = array(
    'Чи є життя на Марсі?',
    'Скільки буде 4*4-17*8+100?',
    'Скільки гномів було у казці "Білосніжка"?',
    'Що таке квантова фізика?',
    'Що треба зробити, щоб виспатись?'
);
// Для спрощення коду правильна відповідь записується першою і має індекс 0
$a_variant_Answer = array(
    array('Є', 'Немає', 'Незнаю', 'Наступне запитання :)'),
    array('-20', '31', '-15', 'Я гуманітарій :)'),
    array('Семеро', 'Гномів чи низькорослих?', 'Шестеро', 'Запитайте в неї'),
    array('Розділ теоретичної фізики', 'Книжка в бібліотеці', 'Незнаю', 'Я гуманітарій :)'),
    array('Лягти спати', 'Подивитись фільм', 'Подивитись мультик', 'Місія не має шансів на успіх :)')
);
// якщо тест не розпочато. форма старту
if (!isset($_SESSION['new_test']) && !isset($_POST['new_test'])
    && !$_SESSION['exit'] && !isset($_COOKIE['counter']))
{
    echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST">';
    echo '<input type="submit" name="new_test" value="Розпочати тест">';
    echo '</form>';
}

    //тест розпочато
    if (isset($_POST['new_test']) && !$_SESSION['new_test'])
    {
        // масив індексів питань
        $_SESSION['index_question'] = range(0, 4);
        shuffle($_SESSION['index_question']);

        // двовимірний масив, індексів варіантів відповідей
        $_SESSION['index_variant'] = array();
        for ($i = 0; $i < 5; $i++)
        {
            $index_variant1 = range(0, 3);
            shuffle($index_variant1);
            $_SESSION['index_variant'][] = $index_variant1;
        }
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
            $_SESSION['answer'][$index_question] = $_POST[$_POST['question']];
            $_SESSION['counter']++;
        }
    }


        if($_SESSION['counter'] > 4)
        {
            if  (!isset($_COOKIE['counter']) && !isset($_COOKIE['answer']))
            {
                setcookie('counter', $_SESSION['counter'], time() + 60 * 60 * 24 * 7);
                setcookie('answer', serialize($_SESSION['answer']), time() + 60 * 60 * 24 * 7);
            }
            $_SESSION['exit'] = true;
        $array_true = $_SESSION['answer'];
        $_SESSION['true'] = 0;
            foreach ($array_true as $value) {

                if (($value !== NULL) && ($value == 0)) $_SESSION['true']++;
            }

        echo 'Вітаю, ви пройшли тест!<br>';
        echo 'Правильних відповідей - ' . $_SESSION['true'] . '<br>';
        echo 'Неправильних відповідей - ' . (5 - $_SESSION['true']) . '<br>';
        echo 'Набрано зі 100 балів - ' . (int)($_SESSION['true']/(count($a_question))*100);
        echo '<p><b>Ваші відповіді</b></p><table>';
        foreach ($array_true as $key => $value)
        {
            if ($value === NULL) $s = 'Відповіді не було';
            else if ($value == 0) $s = 'Правильно!';
                else $s = 'Молодець, але неправильно :)';
            echo '<tr><td>' . $a_question[$key] . '</td>
                    <td>' .$a_variant_Answer[$key][$value]. '</td>
                    <td>'. $s .'</td>
                    </tr>';
        }
    }
    //  тест розпочато і ще не завершено
    if (!$_SESSION['exit'] && $_SESSION['new_test'])
    {
        // індекс питання, вибрано зі змішаного масиву
        $index_question = $_SESSION['index_question'][$_SESSION['counter']];
        // одновимірний масив індексів варіантів
        $index_variant = $_SESSION['index_variant'][$index_question];
        $name_q = 'question' . $index_question;

        echo '<form action = ' . $_SERVER['PHP_SELF'] . ' method="post">';
        echo '<p><b>' . $a_question[$index_question] . '</b></p>';
        echo '<input type="hidden" name="question" value="' . $name_q . '">';
        echo '<input type="hidden" name="counter" value="' . $index_question . '">';

        foreach ($index_variant as $index_v) {
            $name_v = 'variant' . $index_v;

            echo '<input type="radio" name="' . $name_q . '" id="' . $name_v . '" value="'. $index_v .'">';
            echo '<label for="' . $name_v . '">' . $a_variant_Answer[$index_question][$index_v].'</label><br/>';
        }

        echo '<input type="submit" name="next" value="Далі">';
        echo '</form>';
    }
