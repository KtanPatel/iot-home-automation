<?php 

if(isset($_POST['clicked'])){

		$pins = array(19, 20, 21, 26);
		
		//echo "<script type='text/javascript'>alert(".$_POST['relayId'].");</script>";
		
		console.log($_post);
	if($_POST['clicked']  == 'true' ){
		// executing the command : sudo python relay_on.py id
		// where the id is the number of relay that we want to switch on/off
		
		
		//$setmode04=shell_exec("/usr/local/bin/gpio -g mode ".$_POST['relayId']." out");
        $b1_on=shell_exec("/usr/local/bin/gpio -g write ".$pins[(($_POST['relayId'])-1)]." 0");
		
		//exec("sudo python /home/pi/relay_on.py " . $_POST['relayId']);
		echo "1";
	}else{
		
		//$setmode04=shell_exec("/usr/local/bin/gpio -g mode ".$_POST['relayId']." out");
        $b1_on=shell_exec("/usr/local/bin/gpio -g write ".$pins[(($_POST['relayId'])-1)]." 1");
		
		
		//exec("sudo python /home/pi/relay_off.py " . $_POST['relayId']);
		echo "0";
	}
}
