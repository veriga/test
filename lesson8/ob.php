<?php
header('content-type: text/html; charset=utf-8');
function callback($buffer)
{
    return (str_replace("яблука","апельсин", $buffer));
}
ob_start("callback");
?>
<html>
<body>
<p>Це все рівно що порівняти яблука та апельсини.</p>
</body>
</html>
<?php
ob_end_flush();

?>

