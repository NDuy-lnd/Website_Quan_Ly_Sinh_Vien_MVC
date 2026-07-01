
<div class="sv-page">

    <!-- TIÊU ĐỀ -->
    <h2 class="title">DANH SÁCH SINH VIÊN</h2>

    <!-- THANH CHỨC NĂNG -->
    <div class="top-actions">
        <select class="class-select" onchange="changeClass(this.value)">
            <option value="">-- Tất cả các lớp --</option>
            <option value="1" <?= ($lop ?? '') == 1 ? 'selected' : '' ?>>74DCTT24</option>
            <option value="2" <?= ($lop ?? '') == 2 ? 'selected' : '' ?>>74DCTT25</option>
            <option value="3" <?= ($lop ?? '') == 3 ? 'selected' : '' ?>>74DCTT26</option>
        </select>


        <a href="/QuanLySinhVienMVC/public/student/add" class="btn btn-add">
            ➕ Thêm sinh viên
        </a>

        <button class="btn btn-export" onclick="exportExcel()">
            📤 Xuất Excel
        </button>

        <input
            type="text"
            id="searchInput"
            class="search-input"
            placeholder="Tìm theo mã hoặc tên SV"
            value="<?= $q ?? '' ?>">

        <button class="btn" onclick="searchStudent()">🔍 Tìm</button>

    </div>

    <!-- BẢNG SINH VIÊN -->
    <table class="table">
        <thead>
            <tr>
                <th class="col-stt">STT</th>
                <th style="text-align: right" class="col-msv">MSV</th>
                <th style="text-align: center" class="col-name">Họ và tên</th>
                <th class="col-ngaysinh">Ngày sinh</th>
                <th class="col-gioitinh">Giới tính</th>
                <th class="col-diachi">Địa chỉ</th>
                <th class="col-trangthai">Trạng thái</th>
                <th class="col-lop">Lớp</th>
                <th class="col-hanhdong">Hành động</th>
            </tr>


        </thead>

        <tbody>
            <?php if (!empty($students)): ?>
                <?php $stt = 1; ?>
                <?php while ($row = mysqli_fetch_assoc($students)): ?>
                    <tr>
                        <td><?= $stt++ ?></td>
                        <td><?= $row['msv'] ?></td>
                        <td class="col-name"><?= $row['hovaten'] ?></td>
                        <td><?= $row['ngaysinh'] ?></td>
                        <td><?= $row['gioitinh'] ?></td>
                        <td><?= $row['diachi'] ?></td>

                        <td>
                            <span class="status-badge">
                                <?= $row['trangthai'] ?>
                            </span>
                        </td>

                        <!-- HIỂN THỊ TÊN LỚP -->
                        <td><strong><?= $row['tenlop'] ?></strong></td>

                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-edit"
                                    onclick="goEdit(<?= $row['id'] ?>)">
                                    ✏️
                                </button>


                                <button class="btn btn-delete"
                                    onclick="deleteStudent(<?= $row['id'] ?>, this)">
                                    🗑
                                </button>

                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">Không có dữ liệu sinh viên</td>
                </tr>
            <?php endif; ?>
        </tbody>

    </table>

</div>
<script>
    function changeClass(lop) {
        let url = '/QuanLySinhVienMVC/public/student/index';

        if (lop !== '') {
            url += '?lop=' + lop;
        }

        loadContent(url);
    }
</script>

<script>
    function searchStudent() {
        const q = document.getElementById('searchInput').value;
        const lop = document.querySelector('.class-select').value;

        let url = '/QuanLySinhVienMVC/public/student/index?';
        if (lop) url += 'lop=' + lop + '&';
        if (q) url += 'q=' + q;

        loadContent(url);
    }
</script>
<script>
    function deleteStudent(id, btn) {
        if (!confirm("Xóa sinh viên này?")) return;

        fetch('/QuanLySinhVienMVC/public/student/delete/' + id, {
                method: 'POST'
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert("✅ Xóa sinh viên thành công!");

                    // Ở NGUYÊN TRANG – chỉ xóa dòng đó
                    btn.closest('tr').remove();
                } else {
                    alert("❌ Xóa thất bại!");
                }
            })
            .catch(() => {
                alert("❌ Có lỗi xảy ra!");
            });
    }
</script>
<script>
    function goEdit(id) {
        window.location.href = '/QuanLySinhVienMVC/public/student/add?id=' + id;
    }
</script>
<script>
    function exportExcel() {
        const lop = document.querySelector('.class-select').value;
        let url = '/QuanLySinhVienMVC/public/export/excel';

        if (lop) {
            url += '?lop=' + lop;
        }

        window.open(url, '_blank');
    }
</script>