<?php
session_start();
$user = (isset($_SESSION['user'])) ? unserialize($_SESSION['user']) : null;
if ($user == null) {
    header('location: /RoomBook/login_user.php');
} else {
    if ($user['ur_Id'] != "R001") // R001 => USER
    {
        header('location: /RoomBook/admin/index.php');
    }
}
$titleHead = "ตารางห้อง";
$active_tableroom = "active";
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
                        <div class="d-flex justify-content-end my-3">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">แผนที่</button>
                        </div>

                        <table id="table-room" class="table table-striped w-100 text-nowrap"></table>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">แผนที่</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex justify-content-center">
                                    <img src="./src/img/60338.jpg" class="img-fluid">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- end: Content -->
        </div>
    </main>
    <!-- end: Main -->
    <?php include("./layout/script.php"); ?>
    <script type="text/javascript">
        $('#table-room').DataTable({
            ajax: '/RoomBook/backend/service/api_detail_room_list.php',
            // dom: 'Bfrtip',
            // buttons: ['copy', 'csv', 'excel', 'colvis'],
            responsive: true,
            language: {
                url: './src/assets/DataTables/LanguageTable/th.json'
            },
            columnDefs: [{
                    targets: 0,
                    title: "ชื่ออาคาร/ตึก",
                    data: "bd_Name",
                },
                {
                    targets: 1,
                    title: "ชื่อห้อง",
                    data: "r_Name",
                },
                {
                    targets: 2,
                    title: "จำนวนที่นั่ง",
                    data: "r_Seats",
                },
                {
                    targets: 3,
                    title: "ประเภทห้อง",
                    data: "rt_Name",
                },
                {
                    targets: 4,
                    title: "ชั้น",
                    data: "r_Floor",
                },
                {
                    targets: 5,
                    title: "ที่อยู่",
                    data: "bd_Address",
                },
                {
                    targets: 6,
                    title: "ถนน",
                    data: "bd_Road",
                },
                {
                    targets: 7,
                    title: "ตำบล",
                    data: "bd_Subdistrict",
                },
                {
                    targets: 8,
                    title: "อำเภอ",
                    data: "bd_District",
                },
                {
                    targets: 9,
                    title: "จังหวัด",
                    data: "bd_Province",
                },
                // {
                //     targets: 10,
                //     title: "แผนที่",
                //     data: null,
                //     defaultContent: "",
                //     render: function(data, type, row, meta) {
                //         //let txtHTML = `<a target="_blank" href="http://www.google.com/maps/place/${row.bd_Lat},${row.bd_Lng}/@${row.bd_Lat},${row.bd_Lng},17z">แผนที่</a>`;
                //         let txtHTML = `<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">แผนที่</button>`;
                //         return txtHTML;
                //     }
                // }
            ]
        });
    </script>
</body>

</html>