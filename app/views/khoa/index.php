<link rel="stylesheet" href="/QuanLySinhVienMVC/public/assets/css/GiaoDienChinh.css">
<link rel="stylesheet" href="/QuanLySinhVienMVC/public/assets/css/KhoaLop.css">

<div class="page">
    <h2 class="title">QUẢN LÝ KHOA</h2>

    <form id="frmKhoa" class="top-actions">
        <input type="text" name="new_department_name" placeholder="Nhập tên khoa mới..." class="input-search">
        <button type="submit" class="btn">➕ Thêm khoa</button>

        <div style="width: 40px;"></div>

        <input type="text" id="search_keyword" value="<?= $data['old_keyword'] ?? '' ?>" placeholder="Nhập tên khoa cần tìm..." class="input-search">

        <button type="button" onclick="searchKhoa()" class="btn btn-search" style="background-color: #3498db;">
            🔍 Tìm kiếm
        </button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên khoa</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data['departments']) && $data['departments']->num_rows > 0): ?>
                <?php while ($row = $data['departments']->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['tenkhoa']) ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2" style="text-align:center;">Không tìm thấy khoa nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
    document.getElementById('frmKhoa').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('/QuanLySinhVienMVC/public/khoa/store', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    loadContent('/QuanLySinhVienMVC/public/khoa/index');
                } else {
                    alert(data.message || 'Có lỗi xảy ra!');
                }
            })
            .catch(err => {
                console.error(err);
                alert('Không kết nối được server!');
            });
    });

    function searchKhoa() {
        const keyword = document.getElementById('search_keyword').value;
        loadContent('/QuanLySinhVienMVC/public/khoa/index?search_keyword=' + encodeURIComponent(keyword));
    }
</script>