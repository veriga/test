<?php
if (isset($_POST['exit']))
{
    setcookie('login', $login, time() - 60 * 60 * 24 * 7);
    setcookie('password', $password, time() - 60 * 60 * 24 * 7);
    $_COOKIE = array();
    session_destroy();
    $_SESSION = array();
}

$true_login = 'login';
$true_password = 'password';
if (isset($_POST['submit']))
{
    if(!empty($_POST['login']) && !empty($_POST['password']))
    {
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
        if (($login == $true_login)&& ($password == $true_password))
        {
            $_SESSION['error'] ='';
            if ($_POST['remember'] == 'cookie')
            {
                setcookie('login', $login, time() + 60 * 60 * 24 * 7); //хвилина, година, доба
                setcookie('password', $password, time() + 60 * 60 * 24 * 7); //хвилина, година, доба
                /* це для того щоб під час використання куків
                 заходило на сайт відразу, а не після оновлення сторінки
                тому що куки спочатку створюються і тільки під час наступного
                запиту їх можна буде зчитати, можна і просто використати сесію
                але залишив і так.
                */
                $_COOKIE['login'] = $login;
                $_COOKIE['password'] =$password;
            }
            else
            {
                $_SESSION['login'] = $login;
                $_SESSION['password'] = $password;
            }
        }
        else $_SESSION['error'] = 'Логін або пароль введено невірно.';
    }
    else $_SESSION['error'] = 'Не усі дані введено';
}