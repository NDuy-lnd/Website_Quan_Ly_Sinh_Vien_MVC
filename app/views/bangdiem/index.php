<?php
$isDetail = !empty($sv_id);
$data     = $isDetail ? $grades : $allGrades;
?>
<link rel="stylesheet" href="/QuanLySinhVienMVC/public/css/BangDiem.css">
<div class="bd-page">
    <h2>📘 BẢNG ĐIỂM SINH VIÊN</h2>
    <div class="bd-actions">
        <a href="/QuanLySinhVienMVC/public/bangdiem/add"
            class="btn-add-grade">
            ➕ Thêm điểm
        </a>
    </div>


    <!-- CHỌN LỚP -->
    <select onchange="loadContent('?url=bangdiem/index&lop=' + this.value)">
        <option value="">-- Chọn lớp --</option>
        <?php while ($c = $classes->fetch_assoc()): ?>
            <option value="<?= $c['id'] ?>" <?= $lop_id == $c['id'] ? 'selected' : '' ?>>
                <?= $c['tenlop'] ?>
            </option>
        <?php endwhile; ?>
    </select>

    <!-- CHỌN SINH VIÊN -->
    <?php if ($lop_id): ?>
        <select onchange="loadContent('?url=bangdiem/index&lop=<?= $lop_id ?>&sv=' + this.value)">
            <option value="">-- Chọn sinh viên --</option>
            <?php while ($s = $students->fetch_assoc()): ?>
                <option value="<?= $s['id'] ?>" <?= $sv_id == $s['id'] ? 'selected' : '' ?>>
                    <?= $s['hovaten'] ?>
                </option>
            <?php endwhile; ?>
        </select>
    <?php endif; ?>

    <!-- BẢNG ĐIỂM -->
        <table class="table">
            <thead>
                <tr>
                    <?php if (!$isDetail): ?>
                        <th>Sinh viên</th>
                        <th>Lớp</th>
                    <?php endif; ?>
                    <th>Môn học</th>
                    <th>CC</th>
                    <th>GK</th>
                    <th>CK</th>
                    <th>RL</th>
                    <th>Tổng</th>
                    <th>Hệ 4</th>
                    <th>Chữ</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = $data->fetch_assoc()): ?>
                    <tr>
                        <?php if (!$isDetail): ?>
                            <td><?= $row['hovaten'] ?></td>
                            <td><?= $row['tenlop'] ?></td>
                        <?php endif; ?>

                        <td><?= $row['ten_mon'] ?></td>
                        <td><?= $row['diem_chuyencan'] ?></td>
                        <td><?= $row['diem_giua_ky'] ?></td>
                        <td><?= $row['diem_cuoi_ky'] ?></td>
                        <td><?= $row['diem_ren_luyen'] ?></td>
                        <td><?= $row['diem_tong'] ?></td>
                        <td><?= $row['diem_he4'] ?></td>
                        <td><?= $row['diem_chu'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

</div>