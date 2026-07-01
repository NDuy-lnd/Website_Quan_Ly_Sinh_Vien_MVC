<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>StudyNest</title>
    <link rel="stylesheet" href="/QuanLySinhVienMVC/public/assets/css/GiaoDienChinh.css">
    <link rel="stylesheet" href="/QuanLySinhVienMVC/public/assets/css/SinhVien.css">
    <link rel="stylesheet" href="/QuanLySinhVienMVC/public/css/BangDiem.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function loadContent(page) {
            fetch(page)
                .then(res => res.text())
                .then(html => {
                    document.querySelector('.content').innerHTML = html;

                    const targetDiv = document.querySelector('.content');
                    targetDiv.innerHTML = html;
                    const scripts = targetDiv.querySelectorAll("script");

                    scripts.forEach(oldScript => {
                        // Tạo một thẻ script mới hoàn toàn
                        const newScript = document.createElement("script");

                        // Copy toàn bộ nội dung code từ thẻ script cũ sang thẻ mới
                        if (oldScript.src) {
                            newScript.src = oldScript.src; // Nếu là script nạp từ link ngoài (như Chart.js)
                        } else {
                            newScript.text = oldScript.text; // Nếu là code inline vẽ biểu đồ
                        }

                        // Gắn thẻ script mới vào body để trình duyệt bắt buộc phải thực thi code
                        document.body.appendChild(newScript).parentNode.removeChild(newScript);
                    });
                })
                .catch(err => console.error("Lỗi nạp nội dung:", err));
        }
    </script>


</head>


<body>

    <!-- HEADER -->
    <header class="header">

        <div class="hamburger" onclick="toggleMenu()">☰</div>

        <h1 class="title">StudyNest</h1>

    </header>

    <!-- MENU BÊN TRÁI -->
    <nav class="sidebar collapsed" id="sidebar">

        <ul>
            <li class="active" onclick="setActiveMenu(this); home()">
                <span class="icon">🏠</span>
                <span class="text">Trang chủ</span>
            </li>


            <li onclick="setActiveMenu(this); loadContent('/QuanLySinhVienMVC/public/khoa/index')">
                <span class="icon">🏫</span>
                <span class="text">Khoa</span>
            </li>

            <li onclick="setActiveMenu(this); loadContent('/QuanLySinhVienMVC/public/lop/index')">
                <span class="icon">🏷️</span>
                <span class="text">Lớp</span>
            </li>
            <li onclick="setActiveMenu(this); loadContent('/QuanLySinhVienMVC/public/student/index')">

                <span class="icon">👨‍🎓</span>
                <span class="text">Sinh viên</span>
            </li>
            <li onclick="setActiveMenu(this); loadContent('/QuanLySinhVienMVC/public/index.php?url=bangdiem/index')">
                <span class="icon">📘</span>
                <span class="text">Bảng điểm</span>
            </li>

            <li onclick="setActiveMenu(this); loadContent('/QuanLySinhVienMVC/public/index.php?url=hocphanno/index')">
                <span class="icon">⚠️</span>
                <span class="text">Học phần nợ</span>
            </li>


            <li onclick="setActiveMenu(this); loadContent('/QuanLySinhVienMVC/public/index.php?url=bieudo/index')">

                <span class="icon">📊</span>
                <span class="text">Biểu đồ điểm</span>
            </li>

            <li onclick="setActiveMenu(this); loadContent('/QuanLySinhVienMVC/public/notification/index')">
                <span class="icon">🔔</span>
                <span class="text">Thông Báo</span>
            </li>
            <li onclick="setActiveMenu(this); logout()">
                <span class="icon">🚪</span>
                <span class="text">Đăng Xuất</span>
            </li>



        </ul>
    </nav>

    <!-- NỘI DUNG CHÍNH -->
    <div class="content" id="content">
        <h1 align="center">Welcome to <span style="color:#e55225">StudyNest</span></h1>
        <hr>
        <div class="hero">
            <div class="hero-text">
                <h1>
                    <span class="hero-title">StudyNest</span><br>
                    <span class="hero-desc">nền tảng quản lý sinh viên</span><br>
                    <span class="hero-highlight">tiện ích và hiệu quả</span>
                </h1>
                <p>
                    StudyNest là nền tảng quản lý sinh viên tiện ích, giúp giảng viên và nhà trường
                    theo dõi, quản lý thông tin sinh viên một cách ngắn gọn - đầy đủ - chính xác.
                    Hệ thống cung cấp dữ liệu rõ ràng, thống kê nhanh chóng, hỗ trợ quản lý hiệu quả
                    và tiết kiệm thời gian.
                </p>
            </div>

            <div class="hero-logo">
                <img src="/QuanLySinhVienMVC/public/assets/images/logo.png" alt="StudyNest logo">
            </div>
        </div>

        <div class="hero-image">
            <img src="/QuanLySinhVienMVC/public/assets/images/Background.png" alt="StudyNest minh họa">
            <p class="hero-caption">
                StudyNest cung cấp giải pháp quản lý sinh viên tập trung, giúp nhà trường và giảng viên
                quản lý học tập và dữ liệu trên một nền tảng đơn giản, trực quan và hiệu quả.
            </p>
        </div>
        <hr>

        <!-- tính năng -->
        <div class="features">
            <h2 class="features-title">Các tính năng của StudyNest</h2>

            <div class="features-list">
                <div class="feature-item">
                    <div class="feature-icon">💬</div>
                    <p>Chat</p>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">📊</div>
                    <p>Biểu đồ điểm</p>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">📋</div>
                    <p>Danh sách lớp</p>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">🔔</div>
                    <p>Thông báo</p>
                </div>


            </div>
        </div>

    </div>

    <script>
        function toggleMenu() {
            document.getElementById("sidebar").classList.toggle("collapsed");
        }
    </script>

    <script>
        function setActiveMenu(element) {
            // Bỏ active tất cả menu
            document.querySelectorAll('.sidebar li')
                .forEach(li => li.classList.remove('active'));

            // Gán active cho menu được click
            element.classList.add('active');
        }
    </script>

    <script>
        const homeHTML = document.getElementById('content').innerHTML;

        function home() {
            document.getElementById('content').innerHTML = homeHTML;
        }

        function load(url) {
            fetch(url)
                .then(r => r.text())
                .then(t => document.getElementById('content').innerHTML = t);
        }
    </script>

    <script>
        function logout() {
            if (confirm("Bạn có chắc muốn đăng xuất không?")) {
                window.location.href = "/QuanLySinhVienMVC/public/auth/logout";
            }
        }
    </script>



</body>


</html>