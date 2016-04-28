<?php
class array_table
{
    private $array;
    public function __set($name, $value)
    {
        if (($name = 'array') && (is_array($value)))
        {
            $this->$name = $value;
        }
    }
    public function getArray($column)
    {
        $l = count($this->array);
        $i = 0;
        echo '<table><tr>';
        foreach ($this->array as $value)
        {
            echo '<td>' . $value. '</td>';
            $i++;
            if ($i % $column == 0) echo '</tr><tr>';
        }
        if ($i % $column != 0) echo '</tr>';
        echo '</table>';
    }
}

$a = new array_table();
$a->array = range(1,45);
$a->getArray(6);
