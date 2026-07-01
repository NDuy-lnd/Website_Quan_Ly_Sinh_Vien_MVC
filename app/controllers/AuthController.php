<?php
require_once "../app/models/User.php";


class AuthController extends Controller
{

    public function login()
    {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $pass  = $_POST['password'];

            $user = User::findByEmail($email);

            if ($user && password_verify($pass, $user['password'])) {
                $_SESSION['user'] = $user['email'];
                header("Location: /QuanLySinhVienMVC/public/home/index");
                exit;
            } else {
                $error = "Sai email hoặc mật khẩu";
            }
        }

        $this->view("auth/login", ['error' => $error]);
    }

    public function forgot()
    {
        $msg = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_SESSION['reset_email'] = $_POST['email'];
            header("Location: /QuanLySinhVienMVC/public/auth/reset");
            exit;
        }

        $this->view("auth/forgot", ['msg' => $msg]);
    }


    public function reset()
    {
        $success = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_SESSION['reset_email'] ?? '';
            User::updatePassword($email, $_POST['password']);
            unset($_SESSION['reset_email']);
            $success = true;
        }

        $this->view("auth/reset", ['success' => $success]);
    }


    public function logout()
    {
        session_destroy();              // ❌ xóa toàn bộ session
        header("Location: /QuanLySinhVienMVC/public/auth/login");
        exit;
    }
}
