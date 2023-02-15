<?php
include "../class/resp.php";
include "../config/connectiondb.php";
session_start();

$resp = new Resp();
$data_arr = array();
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if ($connect_status == "success") {

        $bd_Id = $_GET['bd_Id'];
        $rt_Id = $_GET['rt_Id'];
        $r_Id = $_GET['r_Id'];
        $r_Floor = $_GET['r_Floor'];

        $sql = "SELECT * FROM room_book.tb_Book as a  inner join room_book.tb_user as b on a.u_Id = b.u_Id  inner join room_book.tb_room as c on a.r_Id = c.r_Id  inner join room_book.tb_roomType as d on c.rt_Id = d.rt_Id  inner join room_book.tb_building as e on e.bd_id = c.bd_Id inner join room_book.tb_UseType as f on a.ut_Id = f.ut_Id where e.bd_Id LIKE '%".$bd_Id."%' AND d.rt_Id LIKE '%".$rt_Id."%' AND c.r_Id LIKE '%".$r_Id."%' AND c.r_Floor LIKE '%".$r_Floor."%' AND b_StatusCancel = '0';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $data_custom = array(
                    'id'=>$row['b_Id'],
                    'title'=>$row['r_Name']." # ".$row['ut_Name'],
                    'start'=> $row['b_StartDateTime'],
                    'end'=> $row['b_EndDateTime'],
                    'backgroundColor'=>$row['ut_Color'],
                    'description'=>"หัวข้อ : ".$row['b_Head']."<br>"."ห้อง : ".$row['r_Name']."<br>"."ผู้จอง : ".$row['u_FirstName']." ".$row['u_LastName']."<br>"."ตำแหน่ง : ".$row['u_Position']."<br>"."ประเภทการใช้ : ".$row['ut_Name']."<br>"."คณะ : ".$row["u_Faculty"]."<br>"
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
