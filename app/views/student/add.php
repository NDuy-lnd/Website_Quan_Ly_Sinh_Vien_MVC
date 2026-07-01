<?php if (!empty($success)): ?>
    <script>
        alert("✅ Thêm sinh viên thành công!");
    </script>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <script>
        alert("❌ <?= $error ?>");
    </script>
<?php endif; ?>


<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm sinh viên</title>
    <link rel="stylesheet" href="/QuanLySinhVienMVC/public/assets/css/ThemSinhVien.css">
</head>

<body>

    <div class="add-student-page">

        <div class="add-student-card">

            <!-- HEADER -->
            <div class="add-header">
                <div class="add-icon">➕</div>
                <h1>Thêm sinh viên mới</h1>
                <p>Vui lòng nhập đầy đủ thông tin sinh viên. Các mục có dấu <b>*</b> là bắt buộc.</p>
            </div>

            <!-- FORM -->
            <form method="post" action="/QuanLySinhVienMVC/public/student/store" class="form-grid">
                <input type="hidden" name="id" value="<?= $student['id'] ?? '' ?>">


                <div class="form-group">
                    <label>Mã sinh viên *</label>
                    <input type="text" name="msv"
                        value="<?= $student['msv'] ?? '' ?>" required>
                </div>

                <div class="form-group">
                    <label>Họ và tên *</label>
                    <input type="text" name="hovaten"
                        value="<?= $student['hovaten'] ?? '' ?>" required>
                </div>

                <div class="form-group">
                    <label>Ngày sinh</label>
                    <input type="date" name="ngaysinh"
                        value="<?= $student['ngaysinh'] ?? '' ?>">
                </div>

                <div class="form-group">
                    <label>Giới tính</label>
                    <select name="gioitinh">
                        <option <?= ($student['gioitinh'] ?? '') == 'Nam' ? 'selected' : '' ?>>Nam</option>
                        <option <?= ($student['gioitinh'] ?? '') == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
                        <option <?= ($student['gioitinh'] ?? '') == 'Khác' ? 'selected' : '' ?>>Khác</option>
                    </select>

                </div>

                <div class="form-group">
                    <label>Điện thoại</label>
                    <input type="text" name="dienthoai"
                        value="<?= $student['dienthoai'] ?? '' ?>">
                </div>

                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" name="diachi"
                        value="<?= $student['diachi'] ?? '' ?>">
                </div>

                <div class="form-group">
                    <label>Trạng thái</label>
                    <select id="trangthai" name="trangthai">
                        <option>Đang học</option>
                        <option>Bảo lưu</option>
                        <option>Đã tốt nghiệp</option>
                        <option>Thôi học</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Lớp</label>
                    <select name="lop_id">
                        <option value="1" <?= ($student['lop_id'] ?? '') == 1 ? 'selected' : '' ?>>74DCTT24</option>
                        <option value="2" <?= ($student['lop_id'] ?? '') == 2 ? 'selected' : '' ?>>74DCTT25</option>
                        <option value="3" <?= ($student['lop_id'] ?? '') == 3 ? 'selected' : '' ?>>74DCTT26</option>
                    </select>


                </div>

                <!-- ACTION -->
                <div class="form-actions">
                    <button id="btnSubmit" type="submit" name="btnLuu" class="btn-save">
                        💾 Lưu sinh viên
                    </button>

                    <button type="button" class="btn-back" onclick="backToStudent()">
                        ⬅ Quay về danh sách
                    </button>

                </div>

            </form>

        </div>

    </div>
    <script>
        function backToStudent() {
            // Quay về trang home
            window.location.href = "/QuanLySinhVienMVC/public/home/index?go=student";
        }
    </script>
    <script>
        function editStudent(id) {
            fetch('/QuanLySinhVienMVC/public/student/get/' + id)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('student_id').value = data.id;
                    document.getElementById('masv').value = data.masv;
                    document.getElementById('hoten').value = data.hoten;
                    document.getElementById('ngaysinh').value = data.ngaysinh;
                    document.getElementById('gioitinh').value = data.gioitinh;
                    document.getElementById('dienthoai').value = data.dienthoai;
                    document.getElementById('diachi').value = data.diachi;
                    document.getElementById('trangthai').value = data.trangthai;
                    document.getElementById('lop_id').value = data.lop_id;

                    document.getElementById('btnSubmit').innerText = "Cập nhật";
                });
        }
    </script>



</body>

</html>