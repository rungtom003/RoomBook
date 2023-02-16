<?php
// $order = (isset($_SESSION['order'])) ? unserialize($_SESSION['order']) : null;
// $count_order = 0;
// if ($order != null) {
//     $count_order = count($order);
// }
?>
<!-- start: Navbar -->
<nav class="px-3 py-2 bg-white rounded shadow">
    <i class="ri-menu-line sidebar-toggle me-3 d-block d-md-none"></i>
    <h5 class="fw-bold mb-0 me-auto" style="font-family: kanit-Regular;"><?= $titleHead ?></h5>
    <div class="dropdown me-3 d-none d-sm-block">
        <!-- <div class="cursor-pointer dropdown-toggle navbar-link" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="ri-notification-line"></i>
        </div>
        <div class="dropdown-menu fx-dropdown-menu">
            <h5 class="p-3 bg-indigo text-light">Notification</h5>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                    <div class="me-auto">
                        <div class="fw-semibold">Subheading</div>
                        <span class="fs-7">Content for list item</span>
                    </div>
                    <span class="badge bg-primary rounded-pill">14</span>
                </a>
            </div>
        </div> -->
        <!-- <a type="button" class="btn btn-primary position-relative" href="/ReserveSpace/cart.php">
            <i class="ri-shopping-cart-line"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                <span id="count-order"><?=$count_order?></span>
                <span class="visually-hidden">unread messages</span>
            </span>
        </a> -->
    </div>
    <div class="dropdown">
        <div class="d-flex align-items-center cursor-pointer dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="me-2 d-none d-sm-block" style="font-family: kanit-Regular;"><?php echo isset($user["u_FirstName"]) ? $user["u_FirstName"] : "" ?> <?php echo isset($user["u_LastName"]) ? $user["u_LastName"] : "" ?></span>
            <img class="navbar-profile-image" src="/ReserveSpace/src/img/user.jpg" alt="Image">
        </div>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" style="font-family: kanit-Regular;" href="#">ข้อมูลส่วนตัว</a></li>
            <li><a class="dropdown-item" style="font-family: kanit-Regular;" href="/RoomBook/backend/service/api_logout.php">ออกจากระบบ</a></li>
        </ul>
    </div>
</nav>
<!-- end: Navbar -->
<script>
</script>