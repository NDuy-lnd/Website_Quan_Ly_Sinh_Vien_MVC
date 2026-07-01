<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập | StudyNest</title>
    <link rel="stylesheet" href="/QuanLySinhVienMVC/public/assets/css/Auth.css">
</head>
<body>

<div class="auth-box">
    <h2>Study<span>Nest</span></h2>

    <form method="post">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mật khẩu" required>

        <?php if (!empty($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <button>Đăng nhập</button>
    </form>

    <a href="/QuanLySinhVienMVC/public/auth/forgot">Quên mật khẩu?</a>
</div>

</body>
</html>
