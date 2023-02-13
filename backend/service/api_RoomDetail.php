<?php
include "../class/resp.php";
include "../config/connectiondb.php";

$resp = new Resp();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($connect_status == "success") {
        $r_Id = $_POST["r_Id"];

        $sql = "SELECT * FROM room_book.tb_room where r_Id = '" . $r_Id . "';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $resp->set_status("success");
            $resp->data = $row;
        } else {
            $resp->set_status("fail");
            $resp->set_message("ไม่มีข้อมูล");
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
