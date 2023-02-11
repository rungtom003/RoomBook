<!-- start: Sidebar -->
<div class="sidebar position-fixed top-0 bottom-0 bg-white border-end">
    <div class="d-flex align-items-center p-3">
        <a href="#" class="sidebar-logo text-uppercase fw-bold text-decoration-none text-indigo fs-4">ระบบจองห้อง</a>
        <i class="sidebar-toggle ri-arrow-left-circle-line ms-auto fs-5 d-none d-md-block"></i>
    </div>
    <ul class="sidebar-menu p-3 m-0 mb-0">
        <li class="sidebar-menu-item <?= isset($active_index) ? $active_index : "" ?>">
            <a href="/RoomBook/admin/index.php">
                <i class="ri-file-user-line sidebar-menu-item-icon"></i>
                หน้าเเรก
            </a>
        </li>
        <li class="sidebar-menu-item <?= isset($active_building) ? $active_building : "" ?>">
            <a href="/RoomBook/admin/building.php">
                <i class="ri-file-user-line sidebar-menu-item-icon"></i>
                อาคาร
            </a>
        </li>
        <li class="sidebar-menu-item <?= isset($active_room) ? $active_room : "" ?>">
            <a href="/RoomBook/admin/room.php">
                <i class="ri-file-user-line sidebar-menu-item-icon"></i>
                ห้อง
            </a>
        </li>
        <li class="sidebar-menu-item <?= isset($active_roomType) ? $active_roomType : "" ?>">
            <a href="/RoomBook/admin/roomType.php">
                <i class="ri-file-user-line sidebar-menu-item-icon"></i>
                ประเภทห้อง
            </a>
        </li>
    </ul>
</div>
<div class="sidebar-overlay"></div>
<!-- end: Sidebar -->