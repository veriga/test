<?php
session_start();
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
    if(!empty($_POST['login']) && !empty($_POST['password'])) {
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
        if (($login == $true_login)&& ($password == $true_password)) {
            $_SESSION['error'] ='';
            if ($_POST['remember'] == 'cookie')
            {
                setcookie('login', $login, time() + 60 * 60 * 24 * 7); //хвилина, година, доба
                setcookie('password', $password, time() + 60 * 60 * 24 * 7); //хвилина, година, доба
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
if ($_SESSION['login']) echo 'Сесія логін ' . $_SESSION['login'] . '<br>';
if ($_SESSION['password']) echo 'Сесія пароль ' . $_SESSION['password'] . '<br>';
if ($_COOKIE['login']) echo 'Кука логін ' . $_COOKIE['login'] . '<br>';
if ($_COOKIE['password']) echo  'Кука пароль ' . $_COOKIE['password'] . '<br>';

if (isset($_COOKIE['login']) && isset($_COOKIE['password']))
{
    $_SESSION['login'] = $_COOKIE['login'];
    $_SESSION['password'] = $_COOKIE['password'];
}

if (isset($_SESSION['login']) && isset($_SESSION['password']))
{
    echo 'Ласкаво просимо ' . $_SESSION['login'];
?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="submit" name="exit" value="Вийти">
    </form>
<?php
}


if (empty($_SESSION['login']))
{
    echo $_SESSION['error'] . '<br>';
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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