<?php
   include('session.php');
?>
<html">
   
   <head>
      <title>Dashboard </title>
      <meta name="viewport" content="width=100%, initial-scale=1">
<link href="bootstrap.css" rel="stylesheet">
<link href="bootstrap-switch.css" rel="stylesheet">
<script src="jquery.js"></script>
<script src="bootstrap-switch.js"></script>

   </head>
   
   <body>
      <h1>Welcome, <?php echo $login_session; ?> .!</h1> 
      <h4><a href = "logout.php">Sign Out</a></h4>
      <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
  <table class="row table table-responsive">
	  <?php
		if($user_check != 'kp'){
	   ?>
  <tr>
    <td><label for="relay1">Light 1</label></td>
    <td><input type="checkbox" name="relay1" id="relay1"></td>
  </tr>
    <tr>
    <td><label for="relay2">Light 2</label></td>
    <td><input type="checkbox" name="relay2" id="relay2"></td>
  </tr><?php } ?>
    <tr>
    <td><label for="relay3">Light 3</label></td>
    <td><input type="checkbox" name="relay3" id="relay3"></td>
  </tr>
    <tr>
    <td><label for="relay4">Light 4</label></td>
    <td><input type="checkbox" name="relay4" id="relay4"></td>
  </tr>


</table>

  <?php
		if($user_check != 'kp'){
	   ?>

<p>Switch 1 is  <span id="feedback1"></span> </p>

<p>Switch 2 is <span id="feedback2"></span> </p>

<?php } ?>

<p>Switch 3 is <span id="feedback3"></span> </p>

<p>Switch 4 is <span id="feedback4"></span> </p>

<p>Any One in Range : <span id="inRange"></span> </p>

<p>Distance : <span id="distance"></span> </p>

      </div>
      
  
<script type="text/javascript">


//setting all buttons off state to be red color
$.fn.bootstrapSwitch.defaults.offColor="danger";



//inicalizing the switch buttons 

$("[name='relay1']").bootstrapSwitch();
$("[name='relay2']").bootstrapSwitch();
$("[name='relay3']").bootstrapSwitch();
$("[name='relay4']").bootstrapSwitch();



//this will be execute when the html is ready
$(document).ready(function(){

	get_status();

});



function get_status(){
	
	
  //ajax request with post method (better to be GET)
  $.ajax({
    method: "GET",
    url: "firstCheck.php",
    data: {}
  })
  .done(function( msg ) {
//	  alert(msg);
    
    msg = JSON.parse(msg);
//  alert(msg);
//    msg = JSON.parse(msg);

//alert(msg);
    
//for loop that is implemented for the feedback divs and buttons state



    for(var i = 0 ; i < 4; i++){
		
      // setting the feedback divs
      if(msg[i] == "0"){
        $("#feedback"+(i+1)).html("Turned On");
        //setting the current button state
      $("[name='relay"+(i+1)+"']").bootstrapSwitch('state',true);
      }else{
        $("#feedback"+(i+1)).html("Turned Off");
        //setting the current button state
      $("[name='relay"+(i+1)+"']").bootstrapSwitch('state',false);
      } 
      
    }
    
   
    $.ajax(
    {
        type: "POST",
        url: "/cgi-bin/Ultrasonic.py",
        dataType: "html",
        success: function(msg)
        {
			$("#distance").html(Number(JSON.parse(msg)));
			if(Number(JSON.parse(msg)) > 60)
				$("#inRange").html("No");
			else
				$("#inRange").html("Yes");
			
        },
        error: function(ex){
			//document.getElementById('distance').innerHTML = "E : "+ JSON.stringify(ex);
		}

    });
	
    setTimeout(function(){get_status();}, 2000); 
  
});	

}


// making onclick event listener for the buttons 
$('input[name="relay1"],'+
  'input[name="relay2"],'+
  'input[name="relay3"],'+
  'input[name="relay4"]').on('switchChange.bootstrapSwitch', function(event, state) {

// checking which button is clicked
var relayID = event.target.id.substring(event.target.id.length - 1);
//debugger;

//alert(relayID);

//ajax POST request
$.ajax({
  method: "POST",
  url: "changeState.php",
  data: { clicked :state , relayId:relayID}
})
  .done(function( msg ) {
  // changing the feedback paragraphs
  if(msg == "1"){
    $("#feedback"+(relayID)).html("Turned On");
  }else{
    $("#feedback"+(relayID)).html("Turned Off");
  } 

  });


});
</script>
    
      
   </body>

</html>
