 <?php 

 	if (isset($_GET['manual'])){
		//Debugging using manual URL variable, include database connection here
	}

 	//Table Really only needs one row, but in case you want to track how often you're required to refresh your token
 	//you can select the latest on
 	$logininfo = mysqli_query($link,"select * from tplink_main where id = (select max(id) id from tplink_main)");

 	while ($getlogininfo = mysqli_fetch_assoc($logininfo)){
 		$cloudUserName = //your TPLINK username
 		$cloudPassword = //your TPLINK Password
 		$terminalUUID = //A unique UUID You create
 		$tplinkid =  //primary ID of your table (ID, probably), to update information.
 	}

	//set POST variables and pass them to the TPLINK API Endpoint to get token
	$url = 'https://wap.tplinkcloud.com';
	$fields = array(
		'method' => 'login',
		'params' => array(
			'appType'=>'Kasa_Android',
			'cloudUserName'=> $cloudUserName,
			'cloudPassword'=>$cloudPassword,
			'terminalUUID'=>$terminalUUID
		)
	);

	include "includes/curlcall.php";

	//Set your token
	$token =$resp['result']['token']; 

	//update your tplink table to store token
	 $update = mysqli_query($link,"update tplink_main set token ='$token' where id=$tplinkid");
	 


	//http://itnerd.space/2017/06/05/remotely-control-your-hs100-timer-api/

?>
