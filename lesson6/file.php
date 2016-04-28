<?php
$src = fopen('file.txt', 'r');
while(!feof($src))
{
    $data = fgets($src,13);
}
fclose($src);
echo '<br/>' . $data;

file_put_contents('file.txt', '987654321');
$src = fopen('file.txt', 'r');
while(!feof($src))
{
    $data = fgets($src,13);
}
fclose($src);
echo '<br/>' . $data;