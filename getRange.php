<?php
// It's a Demonstrate Page for Ajax call of python cgi script.
?>

<html">
   
	<head>
      <title>Range Finder </title>
		<meta name="viewport" content="width=100%, initial-scale=1">
		<link href="bootstrap.css" rel="stylesheet">
		<script src="jquery.js"></script>
<script type="text/javascript">
			
$(document).ready(function(){

	getDist();

});
			
function getDist()
{

    $.ajax(
    {
        type: "POST",
        url: "/cgi-bin/Ultrasonic.py",
        dataType: "html",
        success: function(msg)
        {
        document.getElementById('range').innerHTML = msg;
        },
        error: function(ex){
			document.getElementById('range').innerHTML = "E : "+ JSON.stringify(ex);
		}


    });
}
</script>
	</head>
   
<body>
	<div id="range"></div>
</body>
</html>
