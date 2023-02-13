<?php
include "../class/resp.php";
include "../config/connectiondb.php";

$resp = new Resp();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($connect_status == "success") {

        $rt_Id = $_POST["rt_Id"];

        $sql = "DELETE FROM `room_book`.`tb_roomType` WHERE `rt_Id` = '".$rt_Id."'; ";

        if ($conn->query($sql) === TRUE) {
            $resp->set_message("ลบข้อมูลสำเร็จ");
            $resp->set_status("success");

        } else {
            $resp->set_message("ไม่สามารถลบข้อมูลได้");
            $resp->set_status("fail");
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
