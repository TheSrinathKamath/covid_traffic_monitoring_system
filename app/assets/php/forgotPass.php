<?php
    
    require "init.php";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    $officerId = $_POST["officerId"];

    $sql_1 = "SELECT officer_email FROM officer WHERE officer_official_id = '$officerId'";
    $result_1 = mysqli_query($con, $sql_1);
    $regMail = mysqli_fetch_array($result_1);

    if($regMail !== null){
        $to = $regMail;
        $subject = "Password recovery";
        $txt = "Officer " . $officerId . "\n\nPlease keep this password secure ";
        $headers = "From: webmaster@example.com" . "\r\n"
    }
?>