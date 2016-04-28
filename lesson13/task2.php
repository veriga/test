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
    #bloc
    {
        width: 500px;
        height: 200px;
        margin: 100px auto;
    }
    #top>div
    {
        float: left;
        height: 20px;
        width: 25%;
        background: Peru;
        border-right: 1px solid white;
        box-sizing: border-box;
    }
    #top>div:last-child
    {
        border: none;
    }
    #main
    {
        height: 100%;
        width: 100%;
        background-color: Peru;
    }
</style>
    <script>
        $(function()
        {
            $("#v1").click(function()
            {
                $("#top>div").css('background', 'Peru');
                $("#v1, #main").css('background', 'Green');
            });
            $("#v2").click(function()
            {
                $("#top>div").css('background', 'Peru');
                $("#v2, #main").css('background', 'Crimson');
            });
            $("#v3").click(function()
            {
                $("#top>div").css('background', 'Peru');
                $("#v3, #main").css('background', 'Gold');
            });
            $("#v4").click(function()
            {
                $("#top>div").css('background', 'Peru');
                $("#v4, #main").css('background', 'SteelBlue');
            });
        }

        );
    </script>
</head>
<body>
    <div id="bloc">
        <div id="top">
            <div id="v1"> Вкладка 1 </div>
            <div id="v2"> Вкладка 2 </div>
            <div id="v3"> Вкладка 3 </div>
            <div id="v4"> Вкладка 4 </div>
        </div>
        <div id="main">
        </div>
    </div>
</body>
</html>
