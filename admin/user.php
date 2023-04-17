<?php
session_start();
$user = (isset($_SESSION['user'])) ? unserialize($_SESSION['user']) : null;
if ($user == null) {
    header('location: /RoomBook/login_user.php');
} else {
    if ($user['ur_Id'] != "R002") // R002 => ADMIN
    {
        header('location: /RoomBook/index.php');
    }
}
$titleHead = "สมาชิก";
$active_user = "active";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $titleHead ?></title>
    <?php include("./layout/css.php"); ?>
</head>

<body style="font-family: kanit-Regular;">
    <?php include("./layout/head.php"); ?>
    <!-- start: Main -->
    <main class="bg-light">
        <div class="p-2">
            <?php include("./layout/navmain.php"); ?>
            <!-- start: Content -->
            <div class="py-1" style="font-family: kanit-Regular;">
                <div class="card">
                    <div class="card-body">
                        <table id="table-user" class="table table-striped w-100"></table>
                    </div>
                </div>

            </div>
            <!-- end: Content -->
        </div>
    </main>
    <!-- end: Main -->
    <?php include("./layout/script.php"); ?>
    <script>
        function user_Load() {
            $.ajax({
                url: "/RoomBook/backend/service/api_UserList.php",
                type: "GET",
                dataType: "json",
                success: function(res) {
                    //console.log(res);
                    LoadTable(res.data);
                }
            });

            const LoadTable = (data) => {
                $('#table-user').DataTable({
                    data: data,
                    // dom: 'Bfrtip',
                    // buttons: ['copy', 'csv', 'excel', 'colvis'],
                    responsive: true,
                    language: {
                        url: '../src/assets/DataTables/LanguageTable/th.json'
                    },
                    columnDefs: [{
                            targets: 0,
                            title: "ชื่อ",
                            data: "u_FirstName",
                        },
                        {
                            targets: 1,
                            title: "นามสกุล",
                            data: "u_LastName"
                        },
                        {
                            targets: 2,
                            title: "ชื่อผู้ใช้",
                            data: "u_Username",
                        },
                        {
                            targets: 3,
                            title: "คณะ",
                            data: "u_Faculty",
                        },
                        {
                            targets: 4,
                            title: "ตำแหน่ง",
                            data: "u_Position",
                        },
                        {
                            targets: 5,
                            title: "เบอร์ติดต่อ",
                            data: "u_Phone",
                        },
                        {
                            targets: 6,
                            title: "สิทธ์",
                            data: "ur_Name",
                        },
                        {
                            targets: 7,
                            title: "#",
                            data: null,
                            defaultContent: "",
                            render: function(data, type, row, meta) {
                                const u_Approve = row.u_Approve;
                                let txtBtn = "";
                                if (u_Approve == 0) {
                                    txtBtn = `<button class="btn btn-primary" type="button" onclick="ApproveUser(this)" value='${JSON.stringify(row)}' id="btn_Approve" >อนุมัติ</button>`;
                                } else {
                                    txtBtn = `<button class="btn btn-warning" type="button" onclick="ApproveUser(this)" value='${JSON.stringify(row)}' id="btn_Cancel" >ยกเลิก</button>`;
                                }
                                let txtHTML = "";
                                return `<div class="d-grid gap-2 d-md-block" >
                                        ${txtBtn}
                                        <button class="btn btn-danger" type="button" onclick="DeleteUser(this)" value='${JSON.stringify(row)}' id="btn_Delete" >ลบ</button>
                                    </div>`;
                            }
                        }
                    ]
                });
            }
        }
        user_Load();

        function user_UpdateStatus(elm) {
            let obj = JSON.parse(elm.value);
            let u_Id = obj.u_Id;
            let u_StatusDelete = obj.u_StatusDelete;
            let u_FirstName = obj.u_FirstName;
            let u_LastName = obj.u_LastName;
            let txt = "";
            if (u_StatusDelete == 1) {
                txt = "เพิ่ม"
            } else {
                txt = "ลบ"
            }

            Swal.fire({
                title: 'แจ้งเตือน',
                html: `ต้องการ${txt}ข้อมูล <b>${u_FirstName} ${u_LastName}</b> ใช่หรือไม่`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "/RoomBook/backend/service/api_userUpdateStatus.php",
                        type: "POST",
                        data: {
                            u_Id: u_Id,
                            u_StatusDelete: u_StatusDelete
                        },
                        dataType: "json",
                        success: function(res) {
                            //console.log(res);
                            let message = res.message;
                            let status = res.status;

                            if (status == "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: message,
                                    showConfirmButton: true,
                                    timer: 1500
                                }).then((result) => {
                                    $('#table-user').DataTable().destroy();
                                    user_Load();
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'เเจ้งเตือน',
                                    text: message
                                })
                            }
                        }
                    });

                }
            })


        }

        const DeleteUser = (elm) =>{
            const obj = JSON.parse($(elm).val());
            Swal.fire({
                title: 'แจ้งเตือน',
                icon: 'warning',
                html:"ยืนยันการลบข้อมูล",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "/RoomBook/backend/service/api_delete_user.php",
                        type: "POST",
                        data: {
                            u_Id: obj.u_Id,
                        },
                        dataType: "json",
                        success: function(res) {
                            //console.log(res);
                            let message = res.message;
                            let status = res.status;

                            if (status == "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: message,
                                    showConfirmButton: true,
                                    timer: 1500
                                }).then((result) => {
                                    $('#table-user').DataTable().destroy();
                                    user_Load();
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'เเจ้งเตือน',
                                    text: message
                                })
                            }
                        }
                    });

                }
            })
        }

        const ApproveUser = (elm) =>{
            const obj = JSON.parse($(elm).val());
            let u_Approve = obj.u_Approve;
            let message = "";
            if(u_Approve == 1){
                u_Approve = 0;
                message = "ยืนยันการยกเลิกผู้ใช้";
            }else if(u_Approve == 0){
                u_Approve = 1;
                message = "ยืนยันการอนุมัติผู้ใช้";
            }
            Swal.fire({
                title: 'แจ้งเตือน',
                icon: 'warning',
                html: message,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "/RoomBook/backend/service/api_userApprove.php",
                        type: "POST",
                        data: {
                            u_Id: obj.u_Id,
                            u_Approve: u_Approve
                        },
                        dataType: "json",
                        success: function(res) {
                            //console.log(res);
                            let message = res.message;
                            let status = res.status;

                            if (status == "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: message,
                                    showConfirmButton: true,
                                    timer: 1500
                                }).then((result) => {
                                    $('#table-user').DataTable().destroy();
                                    user_Load();
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'เเจ้งเตือน',
                                    text: message
                                })
                            }
                        }
                    });

                }
            })
        }

    </script>
</body>

</html>