<?php

require_once ('config.php');

$data = file_get_contents("php://input");
$json = json_decode($data, true);

// Get selected values from the JSON
// Lines are partial indented to reflect the nesting of the data

$end_device_ids = $json['end_device_ids'];
	$device_id = $end_device_ids['device_id'];
	$application_id = $end_device_ids['application_ids']['application_id'];



		
$received_at = date('Y-m-d H:i:s');

$uplink_message = $json['uplink_message'];

	$temperature = $uplink_message['decoded_payload']['temp'];
	$humidity = $uplink_message['decoded_payload']['hum'];
	$soilhumidity = $uplink_message['decoded_payload']['soil'];
	$lux = $uplink_message['decoded_payload']['lux'];
	//$f_port = $uplink_message['f_port'];
	//$f_cnt = isset($uplink_message['f_cnt']) ? $uplink_message['f_cnt'] : 0;	// Zero & empty values are not included
	//$frm_payload = $uplink_message['frm_payload'];
	//$rssi = $uplink_message['rx_metadata'][0]['rssi'];
	//$snr = $uplink_message['rx_metadata'][0]['snr'];
	//$data_rate_index = isset($uplink_message['settings']['data_rate_index']) ? $uplink_message['settings']['data_rate_index'] : 0;
	//$consumed_airtime = $uplink_message['consumed_airtime'];


$sqlCommand = "INSERT INTO node2(Fecha, Temp, Hum, Soilhum, Lux) VALUES ('$received_at', '$temperature', '$humidity', '$soilhumidity', '$lux')";


mysqli_query($conn, $sqlCommand);

	echo "1";


?>