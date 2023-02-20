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

        $bd_id = uniqidReal();
        $bd_Name = $_POST["bd_Name"];
        $bd_Floor = $_POST["bd_Floor"];
        $bd_NumRoom = $_POST["bd_NumRoom"];
        $bd_Detail = $_POST["bd_Detail"];
        $bd_Address = $_POST["bd_Address"];
        $bd_Road = $_POST["bd_Road"];
        $bd_Subdistrict = $_POST["bd_Subdistrict"];
        $bd_District = $_POST["bd_District"];
        $bd_Province = $_POST["bd_Province"];
        $bd_Lat = $_POST["bd_Lat"];
        $bd_Lng = $_POST["bd_Lng"];

        $sql = "INSERT INTO `room_book`.`tb_building` (`bd_id`,`bd_Name`, `bd_Floor`, `bd_NumRoom`, `bd_Detail`, `bd_Address`, ";
        $sql .= " `bd_Road`,`bd_Subdistrict`, `bd_District`, `bd_Province`,`bd_Lat`,`bd_Lng` ) ";
        $sql .= "VALUES ('".$bd_id."','" . $bd_Name . "', '" . $bd_Floor . "', '" . $bd_NumRoom . "', '" . $bd_Detail . "', '" . $bd_Address . "', ";
        $sql .= " '" . $bd_Road . "', '" . $bd_Subdistrict . "', '" . $bd_District . "', '" . $bd_Province . "','".$bd_Lat."','".$bd_Lng."' );";

        $sqlCheck = "SELECT * FROM room_book.tb_building where bd_Name = '" . $bd_Name . "';";
        $result = $conn->query($sqlCheck);

        if ($result->num_rows > 0) {
            $resp->set_message("ชื่ออาคารซ้ำ");
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
