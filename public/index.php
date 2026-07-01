<?php
session_start();

require_once '../app/config/config.php';
require_once '../app/core/Database.php';
require_once '../app/core/Controller.php';
require_once '../app/core/App.php';

// Nếu chưa đăng nhập và không phải trang auth
$url = $_GET['url'] ?? '';

if (!isset($_SESSION['user']) && strpos($url, 'auth') !== 0) {
    header("Location: /QuanLySinhVienMVC/public/index.php?url=auth/login");
    exit;
}

new App();
