<?php
if (empty($_SESSION['user']))
{
    echo $_SESSION['error'] . '<br>';
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] . '?page=login'; ?>" method="post">
        <label for="name">Логін</label> <br>
        <input type="text" name="name" id="name"> <br/>
        <label for="password">Пароль</label><br>
        <input type="text" name="password" id="password"><br/>
        <label for="remember">Запам'ятати</label>
        <input type="checkbox" name="remember" id="remember" value="cookie"><br/>
        <input type="submit" name="submit" value="Увійти">
    </form>
    <?php
}