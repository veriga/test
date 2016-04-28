<?php
header('content-type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="http://code.jquery.com/jquery-2.2.2.min.js"> </script>
    <script>
        $(function()
        {
            $('div').css('border', '1px solid blue');
            $('span').css('background', 'red');
            $('.element3').addClass('orange');
            $('.element3').click(function(){
                $(this).toggleClass('orange');
                $('#input1').val('Значення введене');

            });
            $('.element3').html('Слово нове');
        }

        );
    </script>

</head>
<body>
<div class="element3">Елемент 3</div>
<div>Елемент1</div>
<span>Елемент2</span>
<input id="input1" type="text" />

<style>
    .orange {
        color: orange;
        font-weight: bold;
    }
</style>

</body>
</html>