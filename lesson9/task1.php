<?php
header('content-type: text/html; charset=utf-8');
class Numbers
{
    public function __set($name, $value)
    {
        if (($value >=2) &&($value <= 100) && !($value&1))
        {
           $this->$name = $value;
        }
        if (($value >=77) &&($value <= 983) && ($value&1))
        {
            $this->$name = $value;
        }
        if (strlen($value) <= 40)
        {
            $this->$name = $value;
        }
        if (is_int($value))
        {
            $this->$name = $value;
        }
    }
    public function __get($name)
    {
        return $this->$name;
    }

}

$num = new Numbers();
$num->n = 3;
echo  $num->n . ' пусто <br>';
$num->n = 18;
echo $num->n;