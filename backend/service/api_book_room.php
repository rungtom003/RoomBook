<?php
include "../class/resp.php";
include "../config/connectiondb.php";
session_start();

function uniqidReal($lenght = 13)
{
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
$data_arr = array();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($connect_status == "success") {

        $user = unserialize($_SESSION["user"]);

        $b_Id = uniqidReal();
        $u_Id = $user["u_Id"];
        $r_Id = $_POST["r_Id"];
        $b_Head = $_POST["b_Head"];
        $b_NumParticipant = $_POST["b_NumParticipant"];
        $b_StartDateTime = $_POST["b_StartDateTime"];
        $b_EndDateTime = $_POST["b_EndDateTime"];
        $b_Note = $_POST["b_Note"];
        $ut_Id = $_POST["ut_Id"];

        $sql = "INSERT INTO `room_book`.`tb_Book` (`b_Id`, `u_Id`, `r_Id`, `b_Head`, `b_NumParticipant`, `b_StartDateTime`, `b_EndDateTime`, `b_Note` ,`ut_Id`) VALUES ('" . $b_Id . "', '" . $u_Id . "', '" . $r_Id . "', '" . $b_Head . "', '" . $b_NumParticipant . "', '" . $b_StartDateTime . "', '" . $b_EndDateTime . "', '" . $b_Note . "', '" . $ut_Id . "');";

        $sql_check = "SELECT * FROM room_book.tb_Book  WHERE  (";
        $sql_check .= " ((b_StartDateTime >= '" . $b_StartDateTime . "' AND b_StartDateTime < '" . $b_EndDateTime . "') AND (b_EndDateTime > '" . $b_StartDateTime . "' AND b_EndDateTime >= '" . $b_EndDateTime . "')) OR";
        $sql_check .= " ((b_StartDateTime <= '" . $b_StartDateTime . "' AND b_StartDateTime < '" . $b_EndDateTime . "') AND (b_EndDateTime > '" . $b_StartDateTime . "' AND b_EndDateTime >= '" . $b_EndDateTime . "')) OR";
        $sql_check .= " ((b_StartDateTime <= '" . $b_StartDateTime . "' AND b_StartDateTime < '" . $b_EndDateTime . "') AND (b_EndDateTime > '" . $b_StartDateTime . "' AND b_EndDateTime <= '" . $b_EndDateTime . "')) OR";
        $sql_check .= " ((b_StartDateTime = '" . $b_StartDateTime . "' AND b_StartDateTime = '" . $b_EndDateTime . "') AND (b_EndDateTime > '" . $b_StartDateTime . "' AND b_EndDateTime >= '" . $b_EndDateTime . "')) OR";
        $sql_check .= " ((b_StartDateTime <= '" . $b_StartDateTime . "' AND b_StartDateTime < '" . $b_EndDateTime . "') AND (b_EndDateTime = '" . $b_StartDateTime . "' AND b_EndDateTime = '" . $b_EndDateTime . "')) OR";
        $sql_check .= " ((b_StartDateTime > '" . $b_StartDateTime . "' AND b_StartDateTime <= '" . $b_EndDateTime . "') AND (b_EndDateTime > '" . $b_StartDateTime . "' AND b_EndDateTime <= '" . $b_EndDateTime . "'))) AND r_Id = '" . $r_Id . "';";
        $result = $conn->query($sql_check);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($data_arr, $row);
            }
            $resp->data = $data_arr;
            $resp->set_status("fail");
            $resp->set_message("เวลาในการจองทับกัน โปรดตรวจสอบวันเวลาจองห้อง");
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
    $resp->set_status("fail");
}

echo json_encode($resp);
