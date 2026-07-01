<link rel="stylesheet" href="/QuanLySinhVienMVC/public/assets/css/Chart.css">

<div style="margin-bottom:20px;">
    <strong>📍 Chọn lớp:</strong>
    <select onchange="loadContent('/QuanLySinhVienMVC/public/index.php?url=bieudo/index&lop=' + this.value)">
        <option value="">-- Chọn lớp --</option>
        <?php while ($r = $data['lop']->fetch_assoc()): ?>
            <option value="<?= $r['id'] ?>" <?= ($r['id'] == $data['selectedLop']) ? 'selected' : '' ?>>
                <?= $r['tenlop'] ?>
            </option>
        <?php endwhile; ?>
    </select>
</div>

<?php if (!empty($data['selectedLop'])): ?>

    <div class="dashboard-grid">

        <div class="chart-container">
            <div class="chart-header">BIỂU ĐỒ THỐNG KÊ TỔNG GPA SINH VIÊN</div>
            <div class="chart-body">
                <canvas id="gpaChart"></canvas>
            </div>
        </div>

        <div class="chart-container">
            <div class="chart-header">BIỂU ĐỒ THỐNG KÊ TRẠNG THÁI SINH VIÊN</div>
            <div class="chart-body">
                <canvas id="statusChart"></canvas>
            </div>
        </div>

    </div>

    <script>
        (function() {
            if (typeof Chart === 'undefined') return;

            const gpaLabels = <?= json_encode(array_column($data['gpa'], 'muc')) ?>;
            const gpaData = <?= json_encode(array_column($data['gpa'], 'tong')) ?>;

            new Chart(document.getElementById('gpaChart'), {
                type: 'pie',
                data: {
                    labels: gpaLabels,
                    datasets: [{
                        data: gpaData,
                        backgroundColor: ['#28a745', '#17a2b8', '#ffc107', '#fd7e14', '#dc3545']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            const stLabels = <?= json_encode(array_column($data['trangthai'], 'trangthai')) ?>;
            const stData = <?= json_encode(array_column($data['trangthai'], 'tong')) ?>;

            new Chart(document.getElementById('statusChart'), {
                type: 'bar',
                data: {
                    labels: stLabels,
                    datasets: [{
                        label: 'Số lượng',
                        data: stData,
                        backgroundColor: '#4e73df'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        })();
    </script>

<?php endif; ?>