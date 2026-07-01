<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đặt lại mật khẩu | StudyNest</title>
    <link rel="stylesheet" href="/QuanLySinhVienMVC/public/assets/css/Auth.css">
</head>
<body>

<div class="auth-box">
    <h2>Study<span>Nest</span></h2>
    <p class="auth-desc">Tạo mật khẩu mới</p>

    <?php if ($success): ?>
        <p class="success">✔ Đổi mật khẩu thành công</p>
        <a href="/QuanLySinhVienMVC/public/auth/login">Đăng nhập</a>
    <?php else: ?>
        <form method="post">
            <input type="password" name="password" placeholder="Mật khẩu mới" required>
            <button>Lưu mật khẩu</button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>
