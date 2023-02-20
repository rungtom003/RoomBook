<?php
include "../class/resp.php";
include "../config/connectiondb.php";

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

        $r_Id = uniqidReal();
        $bd_Id = $_POST["bd_Id"];
        $rt_Id = $_POST["rt_Id"];
        $r_Name = $_POST["r_Name"];
        $r_Floor = $_POST["r_Floor"];
        $r_Detail = $_POST["r_Detail"];
        $r_Seats = $_POST["r_Seats"];

        $sql = "INSERT INTO `room_book`.`tb_room` (`r_Id`,`bd_Id`, `rt_Id`, `r_Name`, `r_Floor`, `r_Detail`, `r_Seats`) ";
        $sql .= "VALUES ('".$r_Id."','" . $bd_Id . "', '" . $rt_Id . "', '" . $r_Name . "', '" . $r_Floor . "', '" . $r_Detail . "', '".$r_Seats."'); ";

        $sqlCheck = "SELECT * FROM room_book.tb_room where bd_Id = '" . $bd_Id . "' and r_Name = '".$r_Name."'; ";
        $result = $conn->query($sqlCheck);
        if ($result->num_rows > 0) {
            $resp->set_message("ชื่อห้องซ้ำ");
            $resp->set_status("Duplicate");
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
