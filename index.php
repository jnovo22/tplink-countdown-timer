 <?php 

	//Include/add your server connection here

	// GET TOKEN.  You can set one manually first.  It'll be invalid, so it'll fetch a new one later...
 	//Table Really only needs one row, but in case you want to track how often you're required to refresh your token
 	//you can select the latest one

	$tokeninfo = mysqli_query($link,"select id, token from tplink_main where id = (select max(id) id from tplink_main)");

	while ($gettokeninfo = mysqli_fetch_assoc($tokeninfo)){
		$token = $gettokeninfo['token'];  //get your token
		$tplinkid = $gettokeninfo['id'];  //set the ID of your device, useful if using it for other functions later.
	}

	//echoing  for sanity checks.
	echo $token."<BR>";
	echo $tplinkid."<BR>";
 
 	//set the endpoint URL.  Use your region specific endpoint
	$url = "https://use1-wap.tplinkcloud.com/?token=$token";

	//set your JSON array
	$fields = array(
		'method' => 'getDeviceList'
	);

	//call CURL
	include "includes/curlcall.php";
	//print_r($resp['msg']);
	//IF token expires, get new token, and re-try
	if ($resp['msg']=="Token expired"){
		include "gettoken.php";
		echo "<script>window.reload();</script>";
	}


	//IF success device list is retrieved in above method
	print_r($result);

	$i=0;
	$arrcnt = sizeof($result);

	echo "arrcount: $arrcnt";
	while ($i<$arrcnt){
 
	 	$deviceid = $resp['result']['deviceList'][$i]['deviceId'];
	 	$status = $resp['result']['deviceList'][$i]['status'];
	 	$alias = $resp['result']['deviceList'][$i]['alias'];

	 	$devicecheck = mysqli_query($link,"select * from tplink_devices where device_id='$deviceid'");

	 	//loop through any devices and add them to a table
	 	//If you move/rename any of your devices, you may need to update your devices_main table manually for the device name
	 	if (mysqli_num_rows($devicecheck)==0){
	 		$insert = mysqli_query($link,"insert into tplink_devices(device_id,alias)
	 										values('$deviceid','$alias')");
	 	}
	 	$i++;

	}
	//Set the timer, inspired by http://itnerd.space/2017/06/05/remotely-control-your-hs100-timer-api/
	include "settimer.php";


?>
