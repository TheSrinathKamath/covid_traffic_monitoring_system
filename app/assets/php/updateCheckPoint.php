<?php

    require "init.php";

    $officerID = $_POST["officerUID"];
    $currCPID = $_POST["currentCPID"];

    $success = "failed";

    $sql_date = "SELECT date_id FROM travel_date WHERE CURRENT_DATE = date_of_journey";
    $result_date = mysqli_query($con,$sql_date);
    $currDateID = mysqli_fetch_array($result_date);

    $sql_date_CPID = "SELECT o.checkpt_id,o.date_id FROM officer o WHERE o.officer_user_id = '$officerID'";
    $result_date_CPID = mysqli_query($con,$sql_date_CPID);
    $row = mysqli_fetch_array($result_date_CPID);

    if($row["checkpt_id"] == ''){
        $newCPIDArr = $currCPID;
    } else {
        $newCPIDArr = $row["checkpt_id"] . "," . $currCPID;
    }
    if($row["date_id"] == ''){
        $newDateArr = $currDateID["date_id"];
    } else {
        $newDateArr = $row["date_id"] . "," . $currDateID["date_id"];
    }
    
    $sql_query = "UPDATE officer o SET 
                  o.checkpt_id = '$newCPIDArr', o.recent_checkpt = '$currCPID', o.date_id = '$newDateArr' 
                  WHERE o.officer_user_id = '$officerID'";
    $result = mysqli_query($con,$sql_query);

    $response = '';

    if($result !== NULL){
        $success = "successful";
        $sql = "SELECT * FROM check_point WHERE checkpt_id = '$currCPID'";
        $result = mysqli_query($con,$sql);
        $cpData = mysqli_fetch_array($result);
        $response = array("CPID"=>$cpData["checkpt_id"],"CPName"=>$cpData["checkpt_name"]);
    }

    $data = array("success"=>$success,"response"=>$response);
    echo json_encode(array("data"=>$data))
?>