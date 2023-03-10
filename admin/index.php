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
$titleHead = "index";
$active_index = "active";
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

            </div>
            <!-- end: Content -->
        </div>
    </main>
    <!-- end: Main -->
    <?php include("./layout/script.php"); ?>
    <script>
    </script>
</body>

</html>