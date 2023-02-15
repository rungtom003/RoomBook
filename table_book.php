<?php
// session_start();
// $user = (isset($_SESSION['user'])) ? unserialize($_SESSION['user']) : null;
// if($user == null){
//     header('location: /ReserveSpace/login.php');
// }
$titleHead = "ตารางจองห้อง";
$active_tablebook = "active";
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
        $('#table-room').DataTable({
            ajax: '/RoomBook/backend/service/api_detail_book_list.php',
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'colvis'],
            responsive: true,
            language: {
                url: './src/assets/DataTables/LanguageTable/th.json'
            },
            columnDefs: [
                {
                    targets: 0,
                    title: "ชื่อห้อง",
                    data: "r_Name",
                },
                {
                    targets: 1,
                    title: "ประเภทห้อง",
                    data: "rt_Name",
                },
                {
                    targets: 2,
                    title: "ชั้น",
                    data: "r_Floor",
                },
                {
                    targets: 3,
                    title: "ชื่อ",
                    data: "u_FirstName",
                },
                {
                    targets: 4,
                    title: "สกุล",
                    data: "u_LastName",
                },
                {
                    targets: 5,
                    title: "ตำแหน่ง",
                    data: "u_Position",
                },
                {
                    targets: 6,
                    title: "คณะ",
                    data: "u_Faculty",
                },
                {
                    targets: 7,
                    title: "หัวข้อ",
                    data: "b_Head",
                },
                {
                    targets: 8,
                    title: "ประเภทการใช้ห้อง",
                    data: "ut_Name",
                },
                {
                    targets: 9,
                    title: "เวลาเริ่ม",
                    data: "b_StartDateTime",
                },
                {
                    targets: 10,
                    title: "เวลาสิ้นสุด",
                    data: "b_EndDateTime",
                },
                
            ]
        });
    </script>
</body>

</html>