 <?php 

 	if (isset($_GET['manual'])){
		//Debugging using manual URL variable, include database connection here
	}

	//GET token DETAILS

	$tokeninfo = mysqli_query($link,"select token from tplink_main where id = (select max(id) id from tplink_main)");

	while ($gettokeninfo = mysqli_fetch_assoc($tokeninfo)){
		$token = $gettokeninfo["token"];
 
	}

	// Get your device you want to control through the API,  It's set to grab it via Alias name, but use 
	// any identifier that you want.
	$device = mysqli_query($link,"select * from tplink_devices where alias = '{ALIAS}'");

	//Get your device ID and the Current Status:  "On/OFF"
	while ($getdevice = mysqli_fetch_assoc($device)){
		$deviceid = $getdevice["device_id"];
		$currentstatus = $getdevice["status"];
	}


//Set the Endpoing URL again.  Use your region specific endpoint
$url = "https://use1-wap.tplinkcloud.com/?token=$token";


//Get Status of TPLINK
$fields = array(
 			"method"=>"passthrough",
 			"params"=>array(
				"deviceId"=> $deviceid,
				 "requestData"=> json_encode(array(
				 	"system"=>array(
				 		"get_sysinfo"=>null
				 	),
				 	"emeter"=>array(
				 		"get_realtime"=>null
				 	)
				))
			)
		);


//call Curl to get remote information
include "includes/curlcall.php";

//get the current status
$status =  json_decode($resp["result"]["responseData"], true)['system']['get_sysinfo']['relay_state'];

//Sanity check.  Echo the status 
echo "Status: $status";
//1/0  (On/Off);
//echo json_encode($fields);

if ($status ==1){
	//if link is on , create an array to get the countdown/rule data from your device.
	// You may or may not have any rules set up for a particular device
	$fields = array(
				 "method"=>"passthrough", 
				"params"=> array(
						"deviceId"=> $deviceid,
						 "requestData"=> json_encode(array(
							"count_down"=>array(
								 "get_rules"=>null
							) 
						 ))
				)
	);

	//sanity check.  Just outputing JSON fields passed to your curl call
	echo json_encode($fields);

	//CURL call
	include "includes/curlcall.php";

	//get the time remaining in a countdown
	$timeremain =  json_decode($resp["result"]["responseData"], true)['count_down']['get_rules']['rule_list'][0]['remain'];

	//The rule ID for the countdown
	$ruleid =  json_decode($resp["result"]["responseData"], true)['count_down']['get_rules']['rule_list'][0]['id'];


	//sanity check, dump the time remaining
	echo "Time Remaining: $timeremain";
	
	//if time remaining is zero, and the status device is on...
	if ($timeremain ==0 && $status==1){
		//Turn on 2 hour timer..
		$fields = array(
					"method"=>"passthrough",
		 			"params"=> array(
		 						"deviceId"=> $deviceid, 
		 						"requestData"=> json_encode(array(
									"count_down"=>array(
										"edit_rule"=>array(
											"name"=>"test",//name of the rule
											"act"=>0,
											"enable"=>1,//enable rule
											"id"=>$ruleid,//id of rule
											"delay"=>7080//in seconds.  See more below.
										)
		 					)
		 				))
				)
		);

		//call curl
		include "includes/curlcall.php";
	}

}

/**************************

I have this running on a 5 minute interval in a cron job, for a 2 hour countdown. I ran into an issue where at the end of the timer,
 the website would fire before the smartplug would turn off (Timeremain ==0 and status ==1), which would reset the timer.

By setting the timer at an uneven interval (anything that doens't match your check interval), it'll solve that problem


***************************/


?>