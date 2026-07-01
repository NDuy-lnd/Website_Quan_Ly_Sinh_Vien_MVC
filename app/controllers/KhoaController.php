<?php
require_once __DIR__ . '/../models/KhoaModel.php';

class KhoaController
{
    public function index()
    {
        $keyword = $_GET['search_keyword'] ?? '';
        $departments = KhoaModel::getAll($keyword);

        $data = [
            'departments' => $departments,
            'old_keyword' => $keyword
        ];

        require __DIR__ . '/../views/khoa/index.php';
    }

    public function store()
    {
        $tenkhoa = trim($_POST['new_department_name'] ?? '');

        if ($tenkhoa === '') {
            echo json_encode(['status' => 'error', 'message' => 'Tên khoa không được để trống']);
            exit;
        }

        if (KhoaModel::exists($tenkhoa)) {
            echo json_encode(['status' => 'error', 'message' => 'Khoa đã tồn tại']);
            exit;
        }

        KhoaModel::insert($tenkhoa);
        echo json_encode(['status' => 'success']);
        exit;
    }
}
