<?php
include "../class/resp.php";
include "../config/connectiondb.php";

$resp = new Resp();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($connect_status == "success") {

        $rt_Id = $_POST["rt_Id"];
        $rt_Name = $_POST["rt_Name"];

        $sql = "INSERT INTO `room_book`.`tb_roomType` (`rt_Id`,`rt_Name` ) VALUES ('" . $rt_Id . "', '" . $rt_Name . "');";

        $sqlCheckID = "SELECT * FROM room_book.tb_roomType where rt_Id = '" . $rt_Id . "';";
        $sqlCheckName = "SELECT * FROM room_book.tb_roomType where rt_Name = '" . $rt_Name . "';";
        $resultID = $conn->query($sqlCheckID);
        $resultName = $conn->query($sqlCheckName);

        if ($resultID->num_rows > 0) {
            $resp->set_message("รหัสประเภทซ้ำ");
            $resp->set_status("Duplicate ID");
        } else if ($resultName->num_rows > 0) {
            $resp->set_message("ชื่อประเภทซ้ำ");
            $resp->set_status("Duplicate name");
        } else {
            if ($conn->query($sql) === TRUE) {
                $resp->set_message("บันทึกข้อมูลสำเร็จ");
                $resp->set_status("success");
            } else {
                $resp->set_message("ไม่สามารถบันทึกข้อมูลได้");
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
