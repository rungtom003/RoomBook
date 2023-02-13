<?php
include "../class/resp.php";
include "connectdb.php";

$resp = new Resp();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($connect_status == "success") {

        $a_Id = $_POST["a_Id"];
        $a_Name = $_POST["a_Name"];

        $sql = "UPDATE `reserve_space`.`tb_area` SET `a_Name` = '" . $a_Name . "' ";
        $sql .= "WHERE `a_Id` = '" . $a_Id . "';";

        if ($conn->query($sql) === TRUE) {
            $resp->set_message("บันทึกข้อมูลสำเร็จ");
            $resp->set_status("success");

            // $sqlSelect = "SELECT * FROM reserve_space.tb_user where `u_Username` = '" . $u_Username . "' and `u_CardNumber` = '" . $u_CardNumber . "' ;";
            // $result = $conn->query($sqlSelect);
            // if ($result->num_rows > 0) {
            //     $row = $result->fetch_assoc();
            //     $resp->data = $row;
            //     $_SESSION["user"] = serialize($row);
            // }

        } else {
            $resp->set_message("ไม่สามารถบันทึกข้อมูลได้");
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
