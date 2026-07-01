<link rel="stylesheet" href="/QuanLySinhVienMVC/public/css/Hocphanno.css">

<h2 class="title">⚠️ DANH SÁCH HỌC PHẦN NỢ</h2>

<div class="filter-box">
    <label>Chọn lớp:</label>
    <select onchange="changeClass(this.value)">
        <option value="">-- Tất cả lớp --</option>
        <?php while ($c = $classes->fetch_assoc()): ?>
            <option value="<?= $c['id'] ?>"
                <?= ($c['id'] == ($_GET['lop'] ?? '')) ? 'selected' : '' ?>>
                <?= $c['tenlop'] ?>
            </option>
        <?php endwhile; ?>
    </select>
</div>

<table class="table">
    <tr>
        <th>Sinh viên</th>
        <th>Lớp</th>
        <th>Môn học</th>
        <th>Hệ 4</th>
        <th>Chữ</th>
    </tr>

    <?php while ($row = $data->fetch_assoc()): ?>
        <tr>
            <td><?= $row['hovaten'] ?></td>
            <td><?= $row['tenlop'] ?></td>
            <td><?= $row['ten_mon'] ?></td>
            <td><?= $row['diem_he4'] ?></td>
            <td class="fail"><?= $row['diem_chu'] ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<script>
function changeClass(lop) {
    let url = '/QuanLySinhVienMVC/public/hocphanno/index';
    if (lop !== '') url += '?lop=' + lop;
    loadContent(url);
}
</script>
