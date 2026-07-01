<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quên mật khẩu | StudyNest</title>
    <link rel="stylesheet" href="/QuanLySinhVienMVC/public/assets/css/Auth.css">
</head>
<body>

<div class="auth-box">
    <h2>Study<span>Nest</span></h2>
    <p class="auth-desc">Nhập email để đặt lại mật khẩu</p>

    <form method="post">
        <input type="email" name="email" placeholder="Email đã đăng ký" required>

        <?php if (!empty($msg)): ?>
            <p class="success"><?= $msg ?></p>
        <?php endif; ?>

        <button>Tiếp tục</button>
    </form>

    <a href="/QuanLySinhVienMVC/public/auth/login">← Quay lại đăng nhập</a>
</div>

</body>
</html>
