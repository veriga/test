<?php
require_once 'Auth.php';
session_start();
header('content-type: text/html; charset=utf-8');
$page = $_GET['page'];
if ($page == 'login')
{
    require_once 'authorization.php';
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="http://code.jquery.com/jquery-2.2.2.min.js"> </script>
    <script>
        $(function()
        {
            // усі поля скриті
            $("#file").hide();
            $("#login").hide();
            $("#contact").hide();
            $("#home").hide();
            //відриваємо або файл,  якщо був завантажений
            // або головну сторінку
            <?php
            if ($page == 'file')
                 echo  '$("#file").show();';
            else    echo  '$("#home").show();';
            ?>

            // функції натиснення пунктів меню
            $("#nav_file").click(function()
            {
                $("#file").show();
                $("#login").hide();
                $("#contact").hide();
                $("#home").hide();
            }
            );

            $("#nav_login").click(function()
                {
                    $("#file").hide();
                    $("#login").show();
                    $("#contact").hide();
                    $("#home").hide();
                }
            );
            $("#nav_contact").click(function()
                {
                    $("#file").hide();
                    $("#login").hide();
                    $("#contact").show();
                    $("#home").hide();
                }
            );
            $("#nav_home").click(function()
                {
                    $("#file").hide();
                    $("#login").hide();
                    $("#contact").hide();
                    $("#home").show();
                }
            );
        });
    </script>
</head>
<body>
<?php
require_once 'header.php';
if (isset($_SESSION['login']) && isset($_SESSION['password']))
{
    require_once 'nav_user.php';
}
else   require_once 'nav_guest.php';

echo '<main>';
    require_once 'file.php';
    require_once 'login.php';
    require_once 'contact.php';
    require_once 'home.php';
echo '</main>';
?>

</body>
</html>