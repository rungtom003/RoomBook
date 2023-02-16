<!-- start: Sidebar -->
<div class="sidebar position-fixed top-0 bottom-0 bg-white border-end">
    <div class="d-flex align-items-center p-3">
        <a href="/RoomBook/index.php" class="sidebar-logo text-uppercase fw-bold text-decoration-none text-indigo fs-4">ระบบจองห้อง</a>
        <i class="sidebar-toggle ri-arrow-left-circle-line ms-auto fs-5 d-none d-md-block"></i>
    </div>
    <ul class="sidebar-menu p-3 m-0 mb-0">
        <li class="sidebar-menu-item <?= isset($active_home) ? $active_home : "" ?>">
            <a href="/RoomBook/index.php">
                <i class="ri-home-4-line sidebar-menu-item-icon"></i>
                หน้าเเรก
            </a>
        </li>
        <li class="sidebar-menu-item <?= isset($active_book) ? $active_book : "" ?>">
            <a href="/RoomBook/book.php">
                <i class="ri-draft-line sidebar-menu-item-icon"></i>
                จองห้อง
            </a>
        </li>
        <li class="sidebar-menu-item <?= isset($active_calendar_book) ? $active_calendar_book : "" ?>">
            <a href="/RoomBook/calendar_book.php">
                <i class="ri-calendar-todo-line sidebar-menu-item-icon"></i>
                ปฏิทินการจอง
            </a>
        </li>
        <li class="sidebar-menu-item <?= isset($active_tableroom) ? $active_tableroom : "" ?>">
            <a href="/RoomBook/table_room.php">
                <i class="ri-table-line sidebar-menu-item-icon"></i>
                ตารางห้อง
            </a>
        </li>
        <li class="sidebar-menu-item <?= isset($active_tablebook) ? $active_tablebook : "" ?>">
            <a href="/RoomBook/table_book.php">
                <i class="ri-table-line sidebar-menu-item-icon"></i>
                ตารางจองห้อง
            </a>
        </li>
        <li class="sidebar-menu-item <?= isset($active_personal) ? $active_personal : "" ?>">
            <a href="/RoomBook/personal.php">
                <i class="ri-file-user-line sidebar-menu-item-icon"></i>
                ข้อมูลส่วนตัว
            </a>
        </li>
    </ul>
</div>
<div class="sidebar-overlay"></div>
<!-- end: Sidebar -->