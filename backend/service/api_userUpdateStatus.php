<?php
include "../class/resp.php";
include "../config/connectiondb.php";

$resp = new Resp();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($connect_status == "success") {

        date_default_timezone_set("asia/bangkok");
        $u_DateTimeUpdate = date("Y-m-d h:i:s");
        $u_Id = $_POST["u_Id"];
        $u_StatusDelete = $_POST["u_StatusDelete"];


        if($u_StatusDelete == 1){
            $u_StatusDelete = 0;
            $mesage = "เพิ่มผู้ใช้สำเร็จ";
        }else{
            $u_StatusDelete = 1;
            $mesage = "ลบผู้ใช้สำเร็จ";
        }

        $sql = "UPDATE `room_book`.`tb_user` SET `u_StatusDelete`= '".$u_StatusDelete."', `u_DateTimeUpdate` = '".$u_DateTimeUpdate."' ";
        $sql .= "WHERE `u_Id` = '".$u_Id."';";
        if ($conn->query($sql) === TRUE) {
            $resp->set_message($mesage);
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
