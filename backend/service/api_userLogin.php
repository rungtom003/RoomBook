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

        $u_Username = $_POST["u_Username"];
        $u_PasswordHash = $_POST["u_PasswordHash"];

        $sql = "SELECT * FROM room_book.tb_user where u_Username = '".$u_Username."';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (hash_equals(hash("sha256", $u_PasswordHash), $row["u_PasswordHash"]) == true) {
                $resp->set_status("success");
                $resp->set_message("Login สำเร็จ");
                $resp->data = $row;
                $_SESSION["user"] = serialize($row);
            } else {
                $resp->set_status("fail");
                $resp->set_message("รหัสผ่านไม่ถูกต้อง ");
            }
        } else {
            $resp->set_status("fail");
            $resp->set_message("ไม่มีชื่อผู้ใช้");
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
