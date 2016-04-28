<?php
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
switch ($page)
{
    case 'file': require_once 'file.php'; break;
    case 'login': require_once 'login.php'; break;
    case 'contact': require_once 'contact.php'; break;
    default : require_once 'home.php'; break;
}
echo '</main>';
?>

</body>
</html>