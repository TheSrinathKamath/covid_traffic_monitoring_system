<?php

    require "init.php";

    $srchStr = $_POST["searchStr"];
    $success = "failed";
    $count = 0;

    $sql_1 = "SELECT DISTINCT(area_name) FROM places WHERE area_name LIKE '%$srchStr%' ORDER by POSITION('$srchStr' IN area_name) LIMIT 10";
    $result_1 = mysqli_query($con,$sql_1);
    
    while( $row_1 = mysqli_fetch_row($result_1) ){
        
        $success = "successful";

        $response[$count++] = $row_1;
    
    }

    $data = array("success"=>$success,"response"=>$response);
    echo json_encode(array("data"=>$data));
?>