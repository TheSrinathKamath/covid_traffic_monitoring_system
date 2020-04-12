<?php

    require "init.php";

	$officerId = $_POST["officerUID"];
	
	$success = 'failed';

	$sql_get_cpArr = "SELECT checkpt_id FROM `officer` WHERE officer_user_id = '$officerId'";
	$result_get_cpArr = mysqli_query($con,$sql_get_cpArr);
	$cpData = mysqli_fetch_array($result_get_cpArr);

	$checkPointString = $cpData["checkpt_id"];

	//Most used checkpoint logic
	$cpArray = explode(",",$checkPointString);
	$cpAssoc = array_count_values($cpArray);
	arsort($cpAssoc);

	$cpId = array_keys($cpAssoc);

	$i = 0;

	for($i = 0; $i < 3 && $i < count($cpId); $i++){
		$top3CPID[$i] = $cpId[$i];
	}
	$CPIDs = implode(",",$top3CPID);
	// print_r($CPIDs);
	$sql_most_used = "SELECT cp.* FROM officer o, check_point cp 
					  WHERE cp.checkpt_id IN (".$CPIDs.") 
					  AND o.officer_user_id = '$officerId'";
	$result_most_used = mysqli_query($con,$sql_most_used);
	// echo $sql_most_used;
	$count = 0;
	
	while($cpNames = mysqli_fetch_array($result_most_used)){

		$success = "successful";
		$checkPtNames[$count] = $cpNames["checkpt_name"];
        $checkPtId[$count++] = $cpNames["checkpt_id"];

    }

    $response = array("cpId"=>$checkPtId,"cpNames"=>$checkPtNames);

    $data = array("success"=>$success,"response"=>$response);
	echo json_encode(array("data"=>$data));
?>