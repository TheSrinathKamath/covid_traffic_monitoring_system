<?php

use function PHPSTORM_META\type;

require "init.php";

	$userName = $_POST["userName"];
	$passWord = $_POST["userPass"];
	$success = 'failed';

	$sql_query = "SELECT officer_user_id, officer_name
				FROM officer WHERE officer_official_id = '$userName' AND password = '$passWord'";
	$result = mysqli_query($con,$sql_query);
	$row = mysqli_fetch_array($result);

	$response = [];
	
	if($row !== NULL){
		$success = 'successful';
		$response = array("officerId"=>$row["officer_user_id"],
							"officerName"=>$row["officer_name"]);
	}

	$data = array("success"=>$success,"response"=>$response);
	echo json_encode(array("data"=>$data));
	
?>