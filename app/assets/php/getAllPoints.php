<?php

    require "init.php";
    // $officerId = $_PASS["officerID"]
    $success = "failed";

    $sql_query = "SELECT * FROM check_point";
    //to use the below sql query $_PASS["officerID"] is required!
    // $sql_query = "SELECT cp.checkpt_id,cp.checkpt_name FROM check_point cp, officer o WHERE o.officer_user_id = '$officerId' AND o.circle_id = cp.circle_id";
    $result = mysqli_query($con,$sql_query);
    
    $count = 0;

    while($row = mysqli_fetch_array($result)){

        $success = "successful";
        $response[$count++] = array(
                          "CPID"=>$row["checkpt_id"],
                          "cpName"=>$row["checkpt_name"]
                        );
    }

    $data = array("success"=>$success,"response"=>$response);
    echo json_encode(array("data"=>$data));
    
?>