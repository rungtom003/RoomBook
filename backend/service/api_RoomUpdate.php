<?php
include "../class/resp.php";
include "../config/connectiondb.php";

$resp = new Resp();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($connect_status == "success") {

        date_default_timezone_set("asia/bangkok");
        $r_DateTimeUpdate = date("Y-m-d h:i:s");

        $r_Id = $_POST["r_Id"];
        $bd_Id = $_POST["bd_Id"];
        $rt_Id = $_POST["rt_Id"];
        $r_Name = $_POST["r_Name"];
        $r_Floor = $_POST["r_Floor"];
        $r_Detail = $_POST["r_Detail"];
        $r_Seats = $_POST["r_Seats"];

        $sql = "UPDATE `room_book`.`tb_room` SET `bd_Id` = '" . $bd_Id . "', `rt_Id` = '".$rt_Id."', `r_Name`='".$r_Name."', `r_Seats`='".$r_Seats."', ";
        $sql .= "`r_Floor`='".$r_Floor."',`r_Detail`='".$r_Detail."',`r_DateTimeUpdate`='".$r_DateTimeUpdate."' ";
        $sql .= "WHERE `r_Id` = '" . $r_Id . "';";

        $sqlCheck = "SELECT * FROM room_book.tb_room where bd_Id = '" . $bd_Id . "' and r_Name = '".$r_Name."' and r_Id != '".$r_Id."' ; ";
        $result = $conn->query($sqlCheck);
        if ($result->num_rows > 0) {
            $resp->set_message("ชื่อห้องซ้ำ");
            $resp->set_status("Duplicate");
        } else {
            if ($conn->query($sql) === TRUE) {
                $resp->set_message("แก้ไขข้อมูลสำเร็จ");
                $resp->set_status("success");
    
            } else {
                $resp->set_message("ไม่สามารถแก้ไขข้อมูลได้");
                $resp->set_status("fail");
            }
        }
    } else {
        $resp->set_message("connection database fail.");
        $resp->set_status("fail");
    }
} else {
    $resp->set_message("Request method fail.");
    $resp->set_status("");
}

echo json_encode($resp);
