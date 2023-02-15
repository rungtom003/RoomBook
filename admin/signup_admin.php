<?php
// session_start();
// $user = (isset($_SESSION['user'])) ? unserialize($_SESSION['user']) : null;
// if($user == null){
//     header('location: /ReserveSpace/login.php');
// }
$titleHead = "สมัครสมาชิก";
$signup_admin = "active";
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
                        <div class="card col-lg-6">
                            <div class="card-header">
                            สมัครสมาชิก
                            </div>
                            <div class="card-body">
                                <form class="row">
                                    <div class="col-lg-12">
                                        <div class="col">
                                            <label for="u_FirstName" class="form-label">ชื่อ</label>
                                            <input type="text" class="form-control" placeholder="FirstName" id="u_FirstName" >
                                            <div id="emailHelp" class="form-text">We'll </div>
                                        </div>
                                        <div class="col">
                                            <label for="u_LastName" class="form-label">นามสกุล</label>
                                            <input type="text" class="form-control" placeholder="LastName" id="u_LastName">
                                            <div id="emailHelp" class="form-text">We'll </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="col">
                                            <label for="u_Faculty" class="form-label">คณะ</label>
                                            <input type="text" class="form-control" placeholder="Faculty" id="u_Faculty" >
                                            <div id="emailHelp" class="form-text">We'll </div>
                                        </div>
                                        <div class="col">
                                            <label for="u_Position" class="form-label">ตำแหน่ง</label>
                                            <input type="text" class="form-control" placeholder="Position" id="u_Position">
                                            <div id="emailHelp" class="form-text">We'll </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="col">
                                            <label for="u_Username" class="form-label">Username</label>
                                            <input type="text" class="form-control" placeholder="Username" id="u_Username" >
                                            <div id="emailHelp" class="form-text">We'll </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="col">
                                            <label for="u_PasswordHash" class="form-label">Password</label>
                                            <input type="Password" class="form-control" placeholder="Password" id="u_PasswordHash" >
                                            <div id="emailHelp" class="form-text">We'll </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="col">
                                            <label for="u_Phone" class="form-label">เบอร์โทรศัพท์</label>
                                            <input type="text" class="form-control" placeholder="Phone" id="u_Phone" >
                                            <div id="emailHelp" class="form-text">We'll </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>


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
    </script>
</body>

</html>