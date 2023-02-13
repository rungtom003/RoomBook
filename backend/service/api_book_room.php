<?php
include "../class/resp.php";
include "../config/connectiondb.php";
session_start();

function uniqidReal($lenght = 13) {
    if (function_exists("random_bytes")) {
        $bytes = random_bytes(ceil($lenght / 2));
    } elseif (function_exists("openssl_random_pseudo_bytes")) {
        $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
    } else {
        throw new Exception("no cryptographically secure random function available");
    }
    return substr(bin2hex($bytes), 0, $lenght);
}

$resp = new Resp();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($connect_status == "success") {

        //$user = unserialize($_SESSION["user"]);

        $b_Id = uniqidReal();
        $u_Id = "U001";//$user["u_Id"];
        $r_Id = $_POST["r_Id"];
        $b_Head = $_POST["b_Head"];
        $b_NumParticipant = $_POST["b_NumParticipant"];
        $b_StartDateTime = $_POST["b_StartDateTime"];
        $b_EndDateTime = $_POST["b_EndDateTime"];
        $b_Note = $_POST["b_Note"];

        $sql = "INSERT INTO `room_book`.`tb_Book` (`b_Id`, `u_Id`, `r_Id`, `b_Head`, `b_NumParticipant`, `b_StartDateTime`, `b_EndDateTime`, `b_Note`) VALUES ('".$b_Id."', '".$u_Id."', '".$r_Id."', '".$b_Head."', '".$b_NumParticipant."', '".$b_StartDateTime."', '".$b_EndDateTime."', '".$b_Note."');";

        $sql_check = "";

        if ($conn->query($sql) === TRUE) {
            $resp->set_message("บันทึกข้อมูลสำเร็จ");
            $resp->set_status("success");
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
    $resp->set_status("fail");
}

echo json_encode($resp);
