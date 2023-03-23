<?php
include "../class/resp.php";
include "../config/connectiondb.php";

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
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($connect_status == "success") {
        $filename = $_POST['filename'];
        $check = unlink("../../src/img/index_Carousel/".$filename);
        if ($check) {
            $resp->set_message("ลบไฟล์สำเร็จ");
            $resp->set_status("success");
        } else {
            $resp->set_message("ไม่สามารถลบไฟล์ได้");
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
