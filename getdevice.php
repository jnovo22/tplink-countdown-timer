 <?php 

 /*********************


File not required for project.  This was useful for troubleshooting and 
dumping a lot of the CURL Calls/responses,so I'm leaving it in this project.


 **********************/



 	$tokeninfo = mysqli_query($link,"select token from tplink_main where id = (select max(id) id from tplink_main)");

 	while ($gettokeninfo = mysqli_fetch_assoc($tokeninfo)){
 		$gettokeninfo = $gettokeninfo['token'];
 		$gettokeninfo = $gettokeninfo['id'];
 	}


$url = "https://use1-wap.tplinkcloud.com/?token=$token";


$fields = array(
        'method' => 'getDeviceList'
);



$ch = curl_init($url);
// Set the url, number of POST vars, POST data
//Encode the array into JSON.
$jsonDataEncoded = json_encode($fields);

//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);

//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));


//hide the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


//Execute the request
$result = curl_exec($ch);

 curl_close($ch);

//print_r($result);

$resp = json_decode($result,true);

print_r($result);



//http://itnerd.space/2017/06/05/remotely-control-your-hs100-timer-api/