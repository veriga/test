<?php
if (isset($_SESSION['user']))
{
    echo '<div id="exit">Вітаємо на сайті ' . $_SESSION['user']->getUsername();
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="submit" name="exit" value="Вийти">
    </form>
    </div>
    <?php
}
?>
<nav>
    <ul class="navigation">
        <li id="nav_home">Головна сторінка</li>
        <li id="nav_file">Завантаження файлу</li>
        <li id="nav_contact">Контактна інформація</li>
    </ul>
</nav>