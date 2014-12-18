<html>
    <head>
        <script>
            var total_json_comment_stack = [];
            var disaplyed_json_comment_stack = [];
            var display_stack_threshold_pointer = 0;
            var total_comment_last_length = 0;
            var display_new = true;
        </script>
        <style>

            body {
                background: #111;
                color:#eee;
            }

            #main {
                width:650px;
                margin:auto;
            }

        </style>
    </head>
    
    <body>
        <center>
            <div id="main">
                <canvas id="c" width="474" height="931"/> 
            </div>
        </center>
        <br>
        <br>
        <script type="text/javascript" src="./js/three/three.min.js"></script>
        <script type="text/javascript" src="./js/three/libs/stats.min.js"></script>
        <script type="text/javascript" src="./js/fonts/helvetiker_regular.typeface.js"></script>
        <script type="text/javascript" src="./js/jquery.min.js"></script>
        <script type="text/javascript" src="./js/text.js"></script>
        <script type="text/javascript" src="./js/alter.js"></script>      
        <center>
        <p style = "10px;"><font color="white">joselyn mcdonald & michael anzuoni</font> </p>
        </center>
        <script>
            function getCommentsFromDb(){
                $.post('get_comments.php', {id: total_json_comment_stack.length}, function(data){ 
                        var json = JSON.parse(data);
                        for (var i = total_comment_last_length; i < json.length; i++){
                            total_json_comment_stack.push(json[i]);
                        }
                });
            }
            

            function display_new_comments(display_thresh){
                if (display_new == true){
                    getCommentsFromDb();
                    displayed_json_comment_stack = total_json_comment_stack.slice(0, display_thresh);
                    for (var i = 0; i < displayed_json_comment_stack.length; i++){
                        var json = displayed_json_comment_stack[i];
                        var text = json.text;
                        var x = json.x;
                        var y = json.y;
                        display_arbitrary_text(text, x, y);
                    }
                }
            }

            getCommentsFromDb();
            setInterval(function(){ display_new_comments(total_json_comment_stack.length)}, 300);
        </script>

    </body>
</html>   