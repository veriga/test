<?php
    header('content-type:text/html; charset=utf-8');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="http://code.jquery.com/jquery-2.2.2.min.js"> </script>
    <script>
        $(function() {
                $("button").click(function () {
                    $("body p:nth-child(2)").text($("body p:first-child").text());
                });
            }
        )
    </script>
</head>
<body>
<p>Текст першого абзацу</p>
<p></p>
<button>Повторити</button>
</body>
</html>