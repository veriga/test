<?php
// стандартну pow() не використовував, але розписувати для кожного методу довго
class Power
{
    public $a;
    private function pow_n($n)
    {
        if ($n == 0) return 1;
        else  return $this->a*$this->pow_n($n-1);
    }
    public function pow_2()    {
        return $this->pow_n(2);
    }

    public function pow_3()    {
        return $this->pow_n(3);
    }

    public function pow_4() {
        return $this->pow_n(4);
    }

    public function pow_5() {
        return $this->pow_n(5);
    }

    function __construct($n)
    {
        $this->a = $n;
    }
}

$n = new Power(2);
echo $n->pow_5();
echo '<br>' . $n->a;
