<?php
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
		echo $trig_on."<br/>".$trig_off."<br/>".$start_time." - ".$stop_time;
		
		$status=shell_exec("/usr/local/bin/gpio -g read ".$echo."");
/*		while(true){
			$status=shell_exec("/usr/local/bin/gpio -g read ".$echo."");
			if ($status == 0){
				$start_time = time();
				break;
			}
		}
*/
		
/*		while(true){
			$status=shell_exec("/usr/local/bin/gpio -g read ".$echo."");
			if ($status == 1){
				$stop_time = time();
				break;
			}
		}
*/		
		$timeElapse = $stop_time - $start_time;
		$distance = ($timeElapse * 34300)/2;
		
		echo "<br/>".$status." - ".$timeElapse." - ".$distance;
}

getdistance();

?>
