<?php
session_start();
$user = (isset($_SESSION['user'])) ? unserialize($_SESSION['user']) : null;
if ($user == null) {
    header('location: /RoomBook/login_user.php');
} else {
    if ($user['ur_Id'] != "R002") // R001 => USER
    {
        header('location: /RoomBook/index.php');
    }
}
$titleHead = "ข้อมูลการจองห้อง";
$active_dataBookRoom = "active";
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
                        <table id="table-room" class="table table-striped w-100 text-nowrap"></table>
                    </div>
                </div>
            </div>
            <!-- end: Content -->
        </div>
    </main>
    <!-- end: Main -->
    <?php include("./layout/script.php"); ?>
    <script type="text/javascript">
        const dt_table = $('#table-room').DataTable({
            ajax: '/RoomBook/backend/service/api_book_list.php',
            // dom: 'Bfrtip',
            // buttons: ['copy', 'csv', 'excel', 'colvis'],
            responsive: true,
            language: {
                url: '../src/assets/DataTables/LanguageTable/th.json'
            },
            columnDefs: [{
                    targets: 0,
                    title: "ตำแหน่ง",
                    data: "u_Position",
                },
                {
                    targets: 1,
                    title: "ชื่อ",
                    data: "u_FirstName",
                },
                {
                    targets: 2,
                    title: "สกุล",
                    data: "u_LastName",
                },
                {
                    targets: 3,
                    title: "คณะ",
                    data: "u_Faculty",
                },
                {
                    targets: 4,
                    title: "ห้อง",
                    data: "r_Name",
                },
                {
                    targets: 5,
                    title: "หัวข้อ",
                    data: "b_Head",
                },
                {
                    targets: 6,
                    title: "วันที่จอง",
                    data: "b_DateTime",
                },
                {
                    targets: 7,
                    title: "#",
                    data: 'b_ref',
                    render: function(data, type, row, meta) {
                        let txtHTML = `<button type="button" class="btn btn-danger" value="${data}" onclick="btnDelete(this)">ลบ</button>`;
                        return txtHTML;
                    }
                }

            ]
        });

        const btnDelete = (elm) => {

            Swal.fire({
                title: 'แจ้งเตือน',
                icon: 'warning',
                html: "ยืนยันการลบข้อมูลการจอง",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
            }).then((result) => {
                if (result.isConfirmed) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                    $.ajax({
                        url: '/RoomBook/backend/service/api_book_delete.php',
                        type: 'post',
                        data: {
                            b_ref: elm.value
                        },
                        dataType: 'json',
                        success: function(res) {
                            if (res.status === "success") {
                                Toast.fire({
                                    icon: 'success',
                                    title: res.message
                                });
                                dt_table.ajax.reload();
                            } else {
                                Toast.fire({
                                    icon: 'warning',
                                    title: res.message
                                });
                                dt_table.ajax.reload();
                            }
                        }
                    });

                }
            })





        }
    </script>
</body>

</html>