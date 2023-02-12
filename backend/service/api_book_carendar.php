<?php
include "../class/resp.php";
include "../config/connectiondb.php";
session_start();

$resp = new Resp();
$data_arr = array();
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if ($connect_status == "success") {

        $sql = "SELECT * FROM room_book.tb_Book as a inner join room_book.tb_user as b on a.u_Id = b.u_Id inner join room_book.tb_room as c on a.r_Id = c.r_Id inner join room_book.tb_roomType as d on c.rt_Id = d.rt_Id inner join room_book.tb_building as e on e.bd_id = c.bd_Id ;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $data_custom = array(
                    'id'=>$row['b_Id'],
                    'title'=>$row['b_Head']." # ".$row['r_Name']." ผู้จอง : ".$row['u_FirstName']." ".$row['u_LastName'],
                    'start'=> $row['b_StartDateTime'],
                    'end'=> $row['b_EndDateTime']
                    // 'extendedProps'=> array('department'=>'BioChemistry')
                );
                array_push($data_arr,$data_custom);
            }
            $resp->set_status("seccess");
        }
        else{
            $resp->set_status("seccess");
            $resp->set_message("ไม่พบข้อมูล.");
        }

    } else {
        $resp->set_message("connection database fail.");
        $resp->set_status("fail");
    }

}
else
{
    $resp->set_message("Request method fail.");
    $resp->set_status("fail");
}

echo json_encode($data_arr);
