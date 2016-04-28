<?php
class Auth
{
    public $name;
    private $password;

    public function setUsername($name)
    {
        $this->name = $name;
    }

    public function getUsername()
    {
        return $this->name;
    }

    public function login()
    {
        setcookie('login', $this->name, time() + 60*60*24*365);
        setcookie('password', $this->password, time() + 60*60*24*365);
        session_start();
        $_SESSION['login'] = $this->name;
        $_SESSION['password'] = $this->password;
    }

    public function logout()
    {
        setcookie('login', '', time() - 60*60*24*365);
        setcookie('password', '', time() - 60*60*24*365);
        session_start();
        session_destroy();
        $_SESSION = array();
        $_COOKIE = array();
    }

    function __construct($name, $password)
    {
        $this->name = $name;
        $this->password = $password;
    }


}