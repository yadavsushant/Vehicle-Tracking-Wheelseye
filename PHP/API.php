<?php
function get_wheelseye_tracking()
{
	$curl = curl_init();
	$url = "https://api.wheelseye.com/searchVehicle";
	$api_key = XXXXXXXXXX;
	$data = array(
	"accessToken" => $api_key,
	);

	// curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	$url = sprintf("%s?%s", $url, http_build_query($data));

	// OPTIONS:
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

	// EXECUTE:
	$result = curl_exec($curl);
	if(!$result){die("Connection Failure");}
	curl_close($curl);
	$response = json_decode($result);

	$response=$response->data;
	foreach($response as $res)
	{
		$VehicleNo = $res->vNo;
   		$Location = $res->latLngDTO->addr;
   		$Lat = $res->latLngDTO->lat;
   		$Long = $res->latLngDTO->lng;
   		$lat_longi=$Lat.",".$Long;
   		$Date = date("Y-m-d H:i:s",$res->latLngDTO->time);
   		$Speed = $res->speed;
   		$Ignition = $res->ignition;

	}
}
