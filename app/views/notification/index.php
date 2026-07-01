<link rel="stylesheet" href="/QuanLySinhVienMVC/public/assets/css/ThongBao.css">

<div class="sv-page">
    <h2 class="title">DANH SÁCH THÔNG BÁO</h2>
    <div class="top-actions">


        <form method="GET" action="index.php" style="display:flex; gap:10px;">
            <input type="hidden" name="controller" value="notification">
            <input type="hidden" name="action" value="index">

            <select name="lop" id="filter-lop" onchange="searchNotif()">

                <option value=""
                    <?= (!isset($selectedLop) || $selectedLop === '') ? 'selected' : '' ?>>
                    -- Tất cả lớp --
                </option>

                <?php foreach ($classes as $lopItem): ?>
                    <option value="<?= $lopItem['tenlop'] ?>"
                        <?= (isset($selectedLop) && $selectedLop === $lopItem['tenlop']) ? 'selected' : '' ?>>
                        <?= $lopItem['tenlop'] ?>
                    </option>
                <?php endforeach; ?>

            </select>
        </form>


        <button onclick="loadContent('/QuanLySinhVienMVC/public/notification/add')" class="btn">
            ➕ Thêm thông báo mới
        </button>
        <input id="search-notif" type="text" class="search-input" placeholder="Tìm theo tiêu đề...">
        <button class="btn" onclick="searchNotif()">Tìm</button>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tiêu đề</th>
                <th>Loại tin</th>
                <th>Lớp</th>
                <th>Ngày đăng</th>
                <th>Nội Dung</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($notifications)): $stt = 1;
                while ($row = mysqli_fetch_assoc($notifications)): ?>
                    <tr>
                        <td><?= $stt++ ?></td>
                        <td style="text-align:left;"><?= $row['tieude'] ?></td>
                        <td><?= $row['loaitin'] ?></td>
                        <td><?= $row['lop'] ?></td>
                        <td><?= date('d/m/H', strtotime($row['ngaydang'])) ?></td>
                        <td><?= $row['noidung'] ?></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-edit"
                                    onclick="loadContent('/QuanLySinhVienMVC/public/notification/edit/<?= $row['id'] ?>')">
                                    ✏️
                                </button>

                                <button class="btn btn-delete"
                                    onclick="if(confirm('Xóa thông báo này?')) 
    loadContent('/QuanLySinhVienMVC/public/notification/delete/<?= $row['id'] ?>')">
                                    🗑
                                </button>
                            </div>
                        </td>
                    </tr>
            <?php endwhile;
            endif; ?>

        </tbody>
    </table>
</div>



<script>
    function searchNotif() {
        let lop = document.getElementById('filter-lop').value;
        let txt = document.getElementById('search-notif').value;

        loadContent(
            '/QuanLySinhVienMVC/public/notification/search?lop=' +
            encodeURIComponent(lop) +
            '&tieude=' +
            encodeURIComponent(txt)
        );
    }
</script>