<?php
    // session_start();
    // $user = (isset($_SESSION['user'])) ? unserialize($_SESSION['user']) : null;
    // if($user == null){
    //     header('location: /ReserveSpace/login.php');
    // }
    $titleHead = "ประเภทห้อง";
    $active_roomType = "active";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$titleHead?></title>
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
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-primary me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#addAreakModal">เพิ่มประเภทห้อง</button>
                        </div>
                        <table id="table-roomType" class="table table-striped w-100"></table>
                    </div>
                </div>
            </div>
            <!-- end: Content -->
        </div>
    </main>
    <!-- end: Main -->
    <?php include("./layout/script.php"); ?>
    <script>
        function load_RoomType(){
            $.ajax({
                url: "/RoomBook/backend/service/api_RoomTypeList.php",
                type: "GET",
                dataType: "json",
                success: function(res) {
                    //console.log(res);
                    LoadTable(res.data);
                }
            });

            const LoadTable = (data) => {
                $('#table-roomType').DataTable({
                    data: data,
                    dom: 'Bfrtip',
                    buttons: ['copy', 'csv', 'excel', 'colvis'],
                    responsive: true,
                    language: {
                        url: './src/assets/DataTables/LanguageTable/th.json'
                    },
                    columnDefs: [{
                            targets: 0,
                            title: "rt_Id",
                            data: "rt_Id",
                        },
                        {
                            targets: 1,
                            title: "rt_Name",
                            data: "rt_Name",
                        },
                        {
                            targets: 2,
                            title: "#",
                            data: null,
                            defaultContent: "",
                            render: function(data, type, row, meta) {
                                let status = row.u_Approve;
                                const u_Id = row.u_Id;
                                const ur_Id = row.ur_Id;
                                let txtBtn = "";
                                let txtHTML = "";
                                if (status === "0") {
                                        txtBtn = `<button class="btn btn-primary" type="button" id="btn_Approve" onclick="fcApprove(this)" value="${u_Id}">อนุมัติ</button>`;
                                    } else {
                                        txtBtn = `<button class="btn btn-warning" type="button" id="btn_Cancel" onclick="cancelUser(this)" value="${u_Id}">ยกเลิก</button>`;
                                    }
                                    txtHTML = `<div class="d-grid gap-2 d-md-block" >` + txtBtn + `
                                        <button class="btn btn-danger" type="button" id="btn_Delete" onclick="deleteUser(this)" value="${u_Id}">ลบ</button>
                                        </div>`
                                return null;
                            }
                        }
                    ]
                });
            }
        }

        load_RoomType();
    </script>
</body>

</html>