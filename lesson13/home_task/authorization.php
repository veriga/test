<?php
if (isset($_POST['exit']))
{
    $_SESSION['user']->logout();
}

$true_login = 'login';
$true_password = 'password';
if (isset($_POST['submit']))
{
    if(!empty($_POST['name']) && !empty($_POST['password']))
    {
        $login = htmlspecialchars($_POST['name']);
        $password = htmlspecialchars($_POST['password']);
        if (($login == $true_login)&& ($password == $true_password))
        {
            $user = new Auth($login, $password);
            $user->login();
            $_SESSION['user'] = $user;
            $_SESSION['error'] ='';

        }
        else $_SESSION['error'] = 'Логін або пароль введено невірно.';
    }
    else $_SESSION['error'] = 'Не усі дані введено';
}