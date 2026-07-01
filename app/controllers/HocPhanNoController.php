<?php
require_once __DIR__ . '/../models/HocPhanNoModel.php';

class HocPhanNoController
{
    public function index()
    {
        $lop_id = $_GET['lop'] ?? '';

        $classes = HocPhanNoModel::getClasses();
        $data = HocPhanNoModel::getByClass($lop_id);

        require_once __DIR__ . '/../views/hocphanno/index.php';
    }
}
