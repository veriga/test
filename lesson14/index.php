<?php
$array = array(
    'key1' => "value1",
    'key2' => "value2",
    'key3' => "value3",
    'key4' => "value4"
);
$s = json_encode($array);
echo $s . "<br />";
$array = json_decode($s, true);
echo "<pre>";
print_r($array);
echo "</pre>";