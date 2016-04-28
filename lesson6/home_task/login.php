<?php

if (isset($_COOKIE['login']) && isset($_COOKIE['password']))
{
    $_SESSION['login'] = $_COOKIE['login'];
    $_SESSION['password'] = $_COOKIE['password'];
}

if (isset($_SESSION['login']) && isset($_SESSION['password']))
{
    echo 'Вітаємо на сайті ' . $_SESSION['login'];
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] . '?page=login'; ?>" method="post">
        <input type="submit" name="exit" value="Вийти">
    </form>
    <?php
}


if (empty($_SESSION['login']))
{
    echo $_SESSION['error'] . '<br>';
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] . '?page=login'; ?>" method="post">
        <label for="login">Логін</label> <br>
        <input type="text" name="login" id="login"> <br/>
        <label for="password">Пароль</label><br>
        <input type="text" name="password" id="password"><br/>
        <label for="remember">Запам'ятати</label>
        <input type="checkbox" name="remember" id="remember" value="cookie"><br/>
        <input type="submit" name="submit" value="Увійти">
    </form>
    <?php
}