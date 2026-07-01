<link rel="stylesheet" href="/QuanLySinhVienMVC/public/assets/css/ThongBao.css">

<div class="sv-page">
    <h2 class="title"><?= $data['title'] ?></h2>

    <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
       <form id="frmThongBao">

            <!-- ID dùng cho sửa -->
            <input type="hidden" name="id" value="<?= $data['item']['id'] ?? '' ?>">

            <!-- TIÊU ĐỀ -->
            <label class="hero-highlight">Tiêu đề:</label>
            <input
                type="text"
                name="tieude"
                class="search-input"
                style="width:100%; margin-bottom:15px;"
                value="<?= $data['item']['tieude'] ?? '' ?>"
                required
            >

            <div style="display: flex; gap: 20px; margin-bottom:15px;">
                <!-- LOẠI TIN (NHẬP TAY) -->
                <div style="flex:1">
                    <label class="hero-highlight">Loại tin:</label>
                    <select name="loaitin" class="class-select" style="width:100%">
                        <option <?= (($data['item']['loaitin'] ?? '') == 'Thông báo chung') ? 'selected' : '' ?>>
                            Thông báo chung
                        </option>
                        <option <?= (($data['item']['loaitin'] ?? '') == 'Học tập') ? 'selected' : '' ?>>
                            Học tập
                        </option>
                        <option <?= (($data['item']['loaitin'] ?? '') == 'Khẩn cấp') ? 'selected' : '' ?>>
                            Khẩn cấp
                        </option>
                    </select>
                </div>

                <!-- LỚP (LẤY TỪ DATABASE) -->
                <div style="flex:1">
                    <label class="hero-highlight">Lớp:</label>
                    <select name="lop" class="class-select" style="width:100%">
                        <option value="">Tất cả</option>

                        <?php if (!empty($data['dslop'])): ?>
                            <?php foreach ($data['dslop'] as $lopItem): ?>
                                <option
                                    value="<?= $lopItem['tenlop'] ?>"
                                    <?= (isset($data['item']['lop']) && $data['item']['lop'] == $lopItem['tenlop']) ? 'selected' : '' ?>
                                >
                                    <?= $lopItem['tenlop'] ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <!-- NỘI DUNG -->
            <label class="hero-highlight">Nội dung:</label>
            <textarea
                name="noidung"
                class="search-input"
                style="width:100%; height:150px; margin-bottom:20px;"
                required
><?= $data['item']['noidung'] ?? '' ?></textarea>

            <!-- BUTTON -->
            <div style="text-align: right;">
                <button
                    type="button"
                    onclick="loadContent('/QuanLySinhVienMVC/public/notification/index')"
                    class="btn"
                    style="background:#666"
                >
                    Quay lại
                </button>

                <button type="submit" name="btnLuu" class="btn">
                    Lưu thông báo
                </button>
            </div>
        </form>
    </div>
</div>
<script>
document.getElementById('frmThongBao').addEventListener('submit', function(e) {
    e.preventDefault(); // chặn submit thường

    let formData = new FormData(this);

    fetch('/QuanLySinhVienMVC/public/Notification/save', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            loadContent('/QuanLySinhVienMVC/public/notification/index');
        } else {
            alert('Lưu thất bại!');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Có lỗi xảy ra!');
    });
});
</script>