            var canvas = document.getElementById('c');
            var context = canvas.getContext('2d');
            var imageObj = new Image();

            imageObj.src = './test.jpg';
            imageObj.onload = function() {
                context.drawImage(imageObj, 0, 0);
            };
            $('#c').mousedown(function(e){
                if ($('#textAreaPopUp').length == 0) {
                    var mouseX = e.pageX - this.offsetLeft + $("#c").position().left;
                    var mouseY = e.pageY - this.offsetTop;
 
                    //append a text area box to the canvas where the user clicked to enter in a comment
                    var textArea = "<div id='textAreaPopUp' style='position:absolute;top:"+mouseY+"px;left:"+mouseX+"px;z-index:30;'><textarea id='textareaTest' style='width:100px;height:50px;background:transparent'></textarea>";
                    var saveButton = "<input type='button' value='save' id='saveText' onclick='saveTextFromArea("+mouseY+","+mouseX+");'></div>";
                    var appendString = textArea + saveButton;
                    $("#main").append(appendString);
                } else {
                    $('textarea#textareaTest').remove();
                    $('#saveText').remove();
                    $('#textAreaPopUp').remove();
                    var mouseX = e.pageX - this.offsetLeft + $("#c").position().left;
                    var mouseY = e.pageY - this.offsetTop;
                    //append a text area box to the canvas where the user clicked to enter in a comment
                    var textArea = "<div id='textAreaPopUp' style='position:absolute;top:"+mouseY+"px;left:"+mouseX+"px;z-index:30;'><textarea id='textareaTest' style='width:100px;height:50px;background:transparent'></textarea>";
                    var saveButton = "<input type='button' value='save' id='saveText' onclick='saveTextFromArea("+mouseY+","+mouseX+");'></div>";
                    var appendString = textArea + saveButton;
                    $("#main").append(appendString);
                }
            });
           
            function saveTextFromArea(y,x){
                //get the value of the textarea then destroy it and the save button
                var text = $('textarea#textareaTest').val();
                $('textarea#textareaTest').remove();
                $('#saveText').remove();
                $('#textAreaPopUp').remove();
                
                //get the canvas and add the text functions
                var canvas = document.getElementById('c');
                var context = canvas.getContext('2d');
                var font = "sans";
                var fontSize = 16;
                CanvasTextFunctions.enable(context);
                var topY = y - $("#c").position().top;
                var leftX = x - $("#c").position().left;
                context.drawText(font, fontSize, leftX, topY, text);
                context.save();
                context.restore();
                
                writeCommentToDb(text, leftX, topY, getDateTime());

            }

            function display_arbitrary_text(text, x, y){
                console.log(text);
                var canvas = document.getElementById('c');
                var context = canvas.getContext('2d');
                var font = "sans";
                var fontSize = 16;
                CanvasTextFunctions.enable(context);
                context.drawText(font, fontSize, x, y, text);
                context.save();
                context.restore();
            }

            function writeCommentToDb(text, x, y, date){
                $.post('insert_comment.php', {text: text, x: x, y: y, date: date});
            }

            function getDateTime() {
                var now     = new Date(); 
                var year    = now.getFullYear();
                var month   = now.getMonth()+1; 
                var day     = now.getDate();
                var hour    = now.getHours();
                var minute  = now.getMinutes();
                var second  = now.getSeconds(); 
                if(month.toString().length == 1) {
                    var month = '0'+month;
                }
                if(day.toString().length == 1) {
                    var day = '0'+day;
                }   
                if(hour.toString().length == 1) {
                    var hour = '0'+hour;
                }
                if(minute.toString().length == 1) {
                    var minute = '0'+minute;
                }
                if(second.toString().length == 1) {
                    var second = '0'+second;
                }   
                var dateTime = year+'/'+month+'/'+day+' '+hour+':'+minute+':'+second;   
                return dateTime;
             }