<?php
class cookies
{
    public $name;
    public $value;
    public $time;

    public function set_cookie($name, $value, $time = 31536000)
    {
        if ($time > 0) setcookie($name, $value, time() + $time);
    }
    public function del_cookie($name)
    {
        setcookie($name, "", time() - 999);
    }
    public function edit_cookie($name, $value, $time = 31536000)
    {
        if ($time > 0) setcookie($name, $value, time() + $time);
    }

}

$auth = new cookies();
$auth->set_cookie('login', 'veriga');

$auth->edit_cookie('login', 'veriga1');
$auth->del_cookie('login');

foreach ($_COOKIE as $index => $value)
    echo $index . ' ' . $value . '<br />';
echo '</pre>';