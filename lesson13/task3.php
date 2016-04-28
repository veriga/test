<?php
header('content-type: text/html; charset=utf-8');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="http://code.jquery.com/jquery-2.2.2.min.js"> </script>
<style>
    *
    {
        padding: 0;
        margin: 0;
    }
    #container
    {
        margin-top: 100px;
        width: 500px;
        max-width: 7000px;
        height: 100px;
        background: red;
    }
    button
    {
        margin: 10px;
    }

    #box
    {
        display: inline-block;
    }
    #bloc
    {
        float: left;
        width: 100px;
        height: 90px;
        margin: 5px;
        background: yellow;
    }
</style>
<script>
    $(function()
    {
        $("button").click(function()
        {
            $("#box").append(function()
            {
               if (($("#box").width()  + $("#bloc").width()  < $("#container").width())) return '<div id="bloc"></div>';
                else alert('Блок заповнений')
            });
        }
        );
    }

    );
</script>
</head>
<body>
<div>
    <div id="container">
        <div id="box">
            <div id="bloc"></div>
        </div>
    </div>
    <button>Додати</button>
</div>
</body>
</html>
