<?php
include "../class/resp.php";
include "../config/connectiondb.php";

$resp = new Resp();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($connect_status == "success") {

        $u_Id = $_POST["u_Id"];
        $u_Approve = $_POST["u_Approve"];

        $sql = "UPDATE `room_book`.`tb_user` SET `u_Approve` = '" . $u_Approve . "' ";
        $sql .= "WHERE `u_Id` = '" . $u_Id . "';";

        if ($conn->query($sql) === TRUE) {
            if($u_Approve == "1"){
                $resp->set_message("อนุมัติผู้ใช้สำเร็จ");
            }else{
                $resp->set_message("ยกเลิกผู้ใช้สำเร็จ");
            }
            $resp->set_status("success");
        } else {
            if($u_Approve == "1"){
                $resp->set_message("อนุมัติผู้ใช้ไม่สำเร็จ");
            }else{
                $resp->set_message("ยกเลิกผู้ใช้ไม่สำเร็จ");
            }
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
