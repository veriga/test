<?php
if (isset($_SESSION['login']) && isset($_SESSION['password']))
{
    echo '<div id="exit">Вітаємо на сайті ' . $_SESSION['login'];
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] . '?page=login'; ?>" method="post">
        <input type="submit" name="exit" value="Вийти">
    </form>
    </div>
    <?php
}
?>
<nav>
    <ul class="navigation">
        <li><a href="site.php?page=home">Головна сторінка</a></li>
        <li><a href="site.php?page=file">Завантаження файлу</a></li>
        <li><a href="site.php?page=contact" >Контактна інформація</a></li>
    </ul>
</nav>