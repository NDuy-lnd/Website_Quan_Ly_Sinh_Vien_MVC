<?php if (!empty($alert)): ?>
    <script>
        alert("<?= $alert ?>");
    </script>
<?php endif; ?>

<link rel="stylesheet" href="/QuanLySinhVienMVC/public/assets/css/KhoaLop.css">

<div class="page">

    <h2 class="title">QUẢN LÝ LỚP</h2>

    <form class="top-actions"
        method="post"
        action="/QuanLySinhVienMVC/public/lop/index">


        <!-- Ô THÊM LỚP -->
        <input type="text"
            name="tenlop_add"
            placeholder="Nhập tên lớp cần thêm..."
            class="input-search">

        <select name="khoa_id">
            <?php while ($k = $khoa->fetch_assoc()): ?>
                <option value="<?= $k['id'] ?>"><?= $k['tenkhoa'] ?></option>
            <?php endwhile; ?>
        </select>

        <button type="button" class="btn" onclick="addLop()">➕ Thêm lớp</button>


        <!-- Ô TÌM KIẾM -->
        <input type="text"
            name="tenlop_search"
            placeholder="Tìm kiếm tên lớp..."
            class="input-search">

        <button type="button" class="btn btn-search" onclick="searchLop()">🔍 Tìm kiếm</button>

    </form>

    <table class="table">
        <tr>
            <th>STT</th>
            <th>Tên lớp</th>
            <th>Khoa</th>
            <th>Hành động</th>
        </tr>

        <?php $i = 1;
        while ($row = $lop->fetch_assoc()): ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $row['tenlop'] ?></td>
                <td><?= $row['tenkhoa'] ?></td>
                <td>
                    <button class="btn btn-delete"
                        onclick="deleteLop(<?= $row['id'] ?>)">
                        🗑 Xóa
                    </button>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>


</div>
<script>
    function addLop() {
        const tenlop = document.querySelector('[name="tenlop_add"]').value;
        const khoa_id = document.querySelector('[name="khoa_id"]').value;

        if (!tenlop.trim()) {
            alert("❌ Vui lòng nhập tên lớp");
            return;
        }

        fetch('/QuanLySinhVienMVC/public/lop/index', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    action: 'add',
                    tenlop_add: tenlop,
                    khoa_id: khoa_id
                })
            })
            .then(() => {
                alert("✅ Thêm lớp thành công!");
                loadContent('/QuanLySinhVienMVC/public/lop/index');
            });
    }
</script>

<script>
    function searchLop() {
        const keyword = document.querySelector('[name="tenlop_search"]').value;

        fetch('/QuanLySinhVienMVC/public/lop/index', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    action: 'search',
                    tenlop_search: keyword
                })
            })
            .then(res => res.text())
            .then(html => {
                document.querySelector('#content').innerHTML = html;
            });
    }
</script>
<script>
    function deleteLop(id) {
        if (!confirm("Bạn có chắc muốn xóa lớp này không?")) return;

        fetch('/QuanLySinhVienMVC/public/lop/delete/' + id)
            .then(res => res.text())
            .then(msg => {
                alert(msg);
                // load lại danh sách lớp (đúng chuẩn loadContent)
                loadContent('/QuanLySinhVienMVC/public/lop/index');
            })
            .catch(err => {
                alert("❌ Xóa thất bại");
                console.error(err);
            });
    }
</script>