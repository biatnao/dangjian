<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <script src="/Public/statics/js/jquery-1.10.2.min.js"></script>
</head>

<body style="overflow-y: hidden;">

<div id='dd'></div>

<script type="text/javascript">
    
    var data = eval('('+'<?php echo $data; ?>'+')');
    
    var dd = function(data1){
        console.log(data1);
        var html = "<ul>";
        $.each(data1,function(e,t){
            
            html += "<li>dede"+t.id+"dede";
            if(t.sub){
                var vv=dd(t.sub);
                
                html += vv;
            }
            html += "</li>";
        });
        html += "</ul>";
        return html;
    }
    var html = dd(data);
    $('#dd').html(html);
</script>
</body>
</html>