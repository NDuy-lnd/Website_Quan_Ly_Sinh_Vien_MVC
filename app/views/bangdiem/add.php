<style>
    .add-page {
        padding: 20px;
    }

    .add-card {
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        max-width: 900px;
        margin: auto;
        box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
    }

    .add-card h2 {
        text-align: center;
        color: #e55225;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        font-weight: 600;
        display: block;
        margin-bottom: 6px;
    }

    select,
    input {
        width: 100%;
        padding: 8px;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    .form-row {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
    }

    .form-row input {
        flex: 1;
    }

    .actions {
        display: flex;
        justify-content: space-between;
        margin-top: 25px;
    }

    .btn {
        padding: 8px 18px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-weight: 500;
    }

    .btn-save {
        background: #28a745;
        color: #fff;
    }

    .btn-back {
        background: #6c757d;
        color: #fff;
    }
</style>

<div class="add-page">
    <div class="add-card">
        <h2>➕ THÊM ĐIỂM SINH VIÊN</h2>

        <form id="addGradeForm">

            <!-- LỚP -->
            <div class="form-group">
                <label>Lớp</label>
                <select onchange="loadStudents(this.value)" required>
                    <option value="">-- Chọn lớp --</option>
                    <?php while ($c = $classes->fetch_assoc()): ?>
                        <option value="<?= $c['id'] ?>">
                            <?= $c['tenlop'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- SINH VIÊN -->
            <div class="form-group">
                <label>Sinh viên</label>
                <select name="sinhvien_id" id="studentSelect" required>
                    <option value="">-- Chọn sinh viên --</option>
                </select>

            </div>

            <div class="form-group">
                <label>Môn học</label>
                <select name="monhoc_id">
                    <option value="">-- Chọn môn học --</option>
                    <?php while ($m = $monhoc->fetch_assoc()): ?>
                        <option value="<?= $m['id'] ?>">
                            <?= $m['ten_mon'] ?> (<?= $m['so_tin_chi'] ?> TC)
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>


            <!-- ĐIỂM -->
            <div class="form-row">
                <input type="number" step="0.1" name="diem_chuyencan" placeholder="Chuyên cần">
                <input type="number" step="0.1" name="diem_giua_ky" placeholder="Giữa kỳ">
                <input type="number" step="0.1" name="diem_cuoi_ky" placeholder="Cuối kỳ">
            </div>

            <div class="form-row">
                <input type="number" step="0.1" name="diem_ren_luyen" placeholder="Rèn luyện">
            </div>

            <!-- ACTION -->
            <div class="actions">
                <button type="submit" class="btn btn-save">💾 Lưu điểm</button>

                <!-- 🔥 QUAY LẠI BẢNG ĐIỂM GIAO DIỆN CHÍNH -->
                <button type="button"
                    class="btn btn-back"
                    onclick="backToStudent()">
                    ⬅ Quay lại
                </button>

            </div>
        </form>
    </div>
</div>

<script>
    function loadStudents(lopId) {
        fetch('/QuanLySinhVienMVC/public/bangdiem/students?lop_id=' + lopId)
            .then(res => res.json())
            .then(data => {
                const select = document.getElementById('studentSelect');
                select.innerHTML = '<option value="">-- Chọn sinh viên --</option>';
                data.forEach(sv => {
                    select.innerHTML += `<option value="${sv.id}">${sv.hovaten}</option>`;
                });
            });
    }
</script>

<script>
        function backToStudent() {
            // Quay về trang home
            window.location.href = "/QuanLySinhVienMVC/public/home/index?go=student";
        }
    </script>

<script>
    document.getElementById('addGradeForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('/QuanLySinhVienMVC/public/bangdiem/store', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert('✅ Thêm điểm thành công');

                    // reset form để nhập tiếp
                    this.reset();

                    // reset select sinh viên
                    document.getElementById('studentSelect').innerHTML =
                        '<option value="">-- Chọn sinh viên --</option>';
                } else {
                    alert('❌ Thêm điểm thất bại');
                }
            })
            .catch(() => {
                alert('❌ Lỗi hệ thống');
            });
    });
</script>