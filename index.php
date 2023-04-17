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

$titleHead = "Home";
$active_home = "active";
$fileList = glob('./src/img/index_Carousel/*.jpg');
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
                <div class="d-flex justify-content-center">
                    <div id="carouselExampleInterval" class="carousel slide w-75" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            foreach ($fileList as $filename) {
                                if (is_file($filename)) {
                                    //echo $filename, '<br>';
                            ?>
                                    <div class="carousel-item active" data-bs-interval="3000">
                                        <img src="<?= $filename ?>" class="d-block w-100">
                                    </div>
                            <?php }
                            } ?>

                        </div>
                        <?php
                        if (count($fileList) > 0) {
                        ?>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="card my-3">
                    <div class="card-body">
                        <div class="row" id="images" data-masonry='{"percentPosition": true }'>
                            <?php
                            $fileList = glob('./src/img/index_Carousel/*.jpg');
                            foreach ($fileList as $filename) {
                                if (is_file($filename)) {
                                    //echo $filename, '<br>';
                            ?>
                                    <div class="col-lg-3 my-1"><img class="img-thumbnail" src="<?= $filename ?>"></div>
                            <?php }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end: Content -->
        </div>
    </main>
    <!-- end: Main -->
    <?php include("./layout/script.php"); ?>
    <script>
        const viewer = new Viewer(document.getElementById('images'));
    </script>
</body>

</html>