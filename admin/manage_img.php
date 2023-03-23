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
$titleHead = "จัดการรูปหน้าเเรก";
$active_manage_img = "active";
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
                    <div class="p-3 d-flex justify-content-end">
                        <div class="mb-3 mx-3">
                            <label for="formFile" class="form-label">เพิ่มรูปภาพ</label>
                            <input class="form-control" type="file" id="formFile">
                        </div>

                        <button class="btn btn-primary" id="btn-add-img" onclick="addimg()">เพิ่มรูป</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ชื่อไฟล์</th>
                                        <th scope="col">รูป</th>
                                        <th scope="col">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    $fileList = glob('../src/img/index_Carousel/*.jpg');
                                    foreach ($fileList as $filename) {
                                        $i++;
                                        if (is_file($filename)) {
                                            //echo $filename, '<br>';
                                    ?>
                                            <tr>
                                                <th scope="row"><?= $i ?></th>
                                                <td><span><?= basename($filename) ?></span></td>
                                                <td><img src="<?= $filename ?>" width="300px"></td>
                                                <td><button class="btn btn-danger" value="<?= basename($filename) ?>" onclick="deletefile(this)">ลบ</button></td>
                                            </tr>
                                    <?php }
                                    } ?>

                                </tbody>
                            </table>
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
        const addimg = () => {
            const formFile = document.getElementById("formFile").files[0];
            const formData = new FormData();
            formData.append('imgformFile', formFile);
            if (formFile !== undefined) {
                $.ajax({
                    url: "/RoomBook/backend/service/api_add_img.php",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        let message = res.message;

                        if (res.status == "success") {
                            Swal.fire({
                                icon: 'success',
                                title: 'success',
                                text: message,
                                willClose: function() {
                                    window.location.reload();
                                }
                            })

                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'เเจ้งเตือน',
                                text: message
                            })
                        }
                    }
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'เเจ้งเตือน',
                    text: 'กรุณาเลือกรูปภาพ'
                })
            }


        }

        const deletefile = (elm) => {
            const data = {
                filename: $(elm).val()
            }
            $.ajax({
                url: "/RoomBook/backend/service/api_delete_img.php",
                type: "POST",
                data: data,
                dataType: "json",
                success: function(res) {
                    let message = res.message;

                    if (res.status == "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'success',
                            text: message,
                            willClose: function() {
                                window.location.reload();
                            }
                        })

                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'เเจ้งเตือน',
                            text: message
                        })
                    }
                }
            });
        }
    </script>
</body>

</html>