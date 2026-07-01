<?php
require_once "../app/models/Student.php";

class StudentController extends Controller
{
    public function index()
    {
        $lop = $_GET['lop'] ?? '';
        $q   = $_GET['q'] ?? '';

        if ($q != '') {
            $students = Student::search($q, $lop);
        } elseif ($lop != '') {
            $students = Student::getByClass($lop);
        } else {
            $students = Student::getAll();
        }

        $this->view("student/index", [
            'students' => $students,
            'lop' => $lop,
            'q' => $q
        ]);
    }

    // 👉 CHỈ HIỂN THỊ FORM
    public function add()
    {
        $student = null;

        if (!empty($_GET['id'])) {
            $student = Student::findById($_GET['id']);
        }

        $this->view("student/add", [
            'student' => $student,
            'success' => $_SESSION['success'] ?? '',
            'error' => $_SESSION['error'] ?? ''
        ]);

        unset($_SESSION['success'], $_SESSION['error']);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');

        if (!$id) {
            echo json_encode(['success' => false]);
            return;
        }

        $result = Student::deleteById($id);

        echo json_encode([
            'success' => $result
        ]);
    }

    public function get($id)
    {
        header('Content-Type: application/json');

        $student = Student::findById($id);
        echo json_encode($student);
    }




    // 👉 XỬ LÝ THÊM SINH VIÊN
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /QuanLySinhVienMVC/public/student/add");
            exit;
        }

        if (!empty($_POST['id'])) {
            // UPDATE
            Student::update($_POST);
            $_SESSION['success'] = "Cập nhật sinh viên thành công!";
        } else {
            // INSERT
            if (Student::existsMSV($_POST['msv'])) {
                $_SESSION['error'] = "Mã sinh viên đã tồn tại!";
                header("Location: /QuanLySinhVienMVC/public/student/add");
                exit;
            }

            Student::insert($_POST);
            $_SESSION['success'] = "Thêm sinh viên thành công!";
        }

        header("Location: /QuanLySinhVienMVC/public/student/add");
        exit;
    }
    
}
