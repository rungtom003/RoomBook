<?php
include "../class/resp.php";
include "../config/connectiondb.php";

$resp = new Resp();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($connect_status == "success") {

        $password = $_POST["password"];
        $u_Username = $_POST['u_Username'];
        $u_Password_hash = hash("sha256", $password);

        $sql = "UPDATE `room_book`.`tb_user` SET `u_PasswordHash` = '".$u_Password_hash."' WHERE (`u_Username` = '".$u_Username."');";

        if ($conn->query($sql) === TRUE) {
            $resp->set_message("เปลี่ยนรหัสผ่านสำเร็จ");
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
    $resp->set_status("fail");
}

echo json_encode($resp);
