<?php
require_once "../app/models/BangDiemModel.php";

class BangDiemController
{
    public function index()
    {
        $lop_id = $_GET['lop'] ?? '';
        $sv_id  = $_GET['sv'] ?? '';

        $classes  = BangDiemModel::getAllClasses();
        $students = $lop_id ? BangDiemModel::getStudentsByClass($lop_id) : [];
        $allGrades = BangDiemModel::getAllGrades();
        $grades   = $sv_id ? BangDiemModel::getGradesByStudent($sv_id) : [];

        require "../app/views/bangdiem/index.php";
    }

    // Hiển thị form thêm điểm
    public function add()
    {
        $classes = BangDiemModel::getAllClasses();
        $monhoc  = BangDiemModel::getAllSubjects();
        require "../app/views/bangdiem/add.php";
    }

    // API: lấy sinh viên theo lớp (AJAX)
    public function students()
    {
        $lop_id = $_GET['lop_id'] ?? 0;
        $result = [];

        if ($lop_id) {
            $students = BangDiemModel::getStudentsByClass($lop_id);
            while ($row = $students->fetch_assoc()) {
                $result[] = $row;
            }
        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    // Lưu điểm
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ok = BangDiemModel::insert($_POST);

            header('Content-Type: application/json');
            echo json_encode([
                'success' => $ok
            ]);
            exit;
        }
    }
}
