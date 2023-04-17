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

        isset($_FILES['imgformFile']) ? $file = $_FILES['imgformFile'] : $file = null;
        $file_name_custom = null;

        if (isset($file) && $file != null) {

            if (filesize($file["tmp_name"]) > 0) {

                $filetypename = pathinfo($file['name'], PATHINFO_EXTENSION);
                $file_name_custom = uniqidReal() . "." . $filetypename;

                $checkupload = move_uploaded_file(
                    $file["tmp_name"],
                    "../../src/img/index_Carousel/" . $file_name_custom
                );
                if ($checkupload) {
                    $resp->set_message("เพิ่มรูปภาพสำเร็จ");
                    $resp->set_status("success");
                }
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
