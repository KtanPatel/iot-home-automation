<?php
   include('session.php');
?>
<?php 


$output = array();
$pins = array(19, 20, 21, 26);
$trig = 18;
$echo = 24;
$setmode=shell_exec("/usr/local/bin/gpio -g mode ".$trig." out");
$setmode=shell_exec("/usr/local/bin/gpio -g mode ".$echo." in");
	
 function getdistance(){
		
		$trig_on=shell_exec("/usr/local/bin/gpio -g write ".$trig." 1");
		sleep(0.00001);
		$trig_off=shell_exec("/usr/local/bin/gpio -g write ".$trig." 0");
		$start_time = time();
		$stop_time = time();		
		
		while(true){
			$status=shell_exec("/usr/local/bin/gpio -g read ".$echo."");
			if ($status == 0){
				$start_time = time();
				break;
			}
		}
		
		while(true){
			$status=shell_exec("/usr/local/bin/gpio -g read ".$echo."");
			if ($status == 1){
				$stop_time = time();
				break;
			}
		}
		
		$timeElapse = $stop_time - $start_time;
		$distance = ($timeElapse * 34300)/2;
		
		return $distance;
}

foreach($pins as $pin){
	$setmode=shell_exec("/usr/local/bin/gpio -g mode ".$pin." out");
	$status=shell_exec("/usr/local/bin/gpio -g read ".$pin);
//	$status = $pin;
	array_push($output,str_replace("\n", '', $status));
}
	
	array_push($output,str_replace("\n", '', 56));
echo json_encode($output); 

?>
