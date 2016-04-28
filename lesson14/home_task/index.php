<?php
header('content-type: text/html; charset=utf-8');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="http://code.jquery.com/jquery-2.2.2.min.js"> </script>
    <script>
        $(document).ready(function()
        {

            <?php
                if (isset($_COOKIE['counter'])
                    && isset($_COOKIE['id'])
                        && isset($_COOKIE['index_question']))
            {
                echo<<<END
                $.ajax({
                    type: 'POST',
                    url: 'test.php',
                    data: 'session=1',
                    success: function(result){
                        a = $.parseJSON(result);
                        index_question = JSON.stringify(a.index_question);
                        id = a.id;
                        counter = a.counter;
                        if (counter == 0) counter++;
                        test(id, index_question, counter-1, -1);
                    }
                });
END;
            }
            ?>
            if (typeof(id) == "undefined"){
                $("#box").html('<button id="new_test">Розпочати тест</button>');
            }
            $("#new_test").click(function()
            {
                $("#new_test").hide();
                counter = 999; //
                $.ajax({
                    type: 'POST',
                    url: 'test.php',
                    data: 'counter=' + counter,
                    success: function(){
                        $.ajax({
                            type: 'POST',
                            url: 'test.php',
                            data: 'session=1',
                            success: function(result){
                                a = $.parseJSON(result);
                                index_question = JSON.stringify(a.index_question);
                                id = a.id;
                                counter = a.counter;
                                test(id, index_question, counter, -1);
                            }
                        });

                    }
                });
            });
            $("body").on('click',"#next_button", function() {
                i_question = $("input[name=counter]").val();
                answer = $("input[name=" + i_question + "]:checked").val();
                $.ajax({
                    type: 'POST',
                    url: 'test.php',
                    data: 'session=1',
                    success: function(result){
                        a = $.parseJSON(result);
                        index_question = JSON.stringify(a.index_question);
                        id = a.id;
                        counter = a.counter;
                        test(id, index_question, counter, answer);
                    }
                });
            });
        });

        function test(id, index_question, counter, answer)
        {
            $.ajax({
                type: 'POST',
                url: 'test.php',
                data: 'counter=' + counter + '&id=' + id +
                        '&index_question=' + index_question + '&answer=' + answer,
                success: function(result){
                    $('#box').html(result);
                }
            })
        }

    </script>
    <style>
        body
        {
            text-align: center;
        }

        #box
        {
            display: inline-block;
            width: 200px;
            text-align: left;
        }
        </style>
</head>
<body>
    <div id="box">

    </div>
</body>
</html>
