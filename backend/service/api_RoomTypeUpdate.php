<?php
include "../class/resp.php";
include "../config/connectiondb.php";

$resp = new Resp();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($connect_status == "success") {

        date_default_timezone_set("asia/bangkok");
        $rt_DateTimeUpdate = date("Y-m-d h:i:s");
        $rt_Id = $_POST["rt_Id"];
        $rt_Name = $_POST["rt_Name"];

        $sql = "UPDATE `room_book`.`tb_roomType` SET `rt_Name` = '" . $rt_Name . "', `rt_DateTimeUpdate` = '".$rt_DateTimeUpdate."' ";
        $sql .= "WHERE `rt_Id` = '" . $rt_Id . "';";

        $sqlCheckName = "SELECT * FROM room_book.tb_roomType where rt_Name = '" . $rt_Name . "';";
        $resultName = $conn->query($sqlCheckName);

        if ($resultName->num_rows > 0) {
            $resp->set_message("ชื่อประเภทซ้ำ");
            $resp->set_status("Duplicate name");
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
