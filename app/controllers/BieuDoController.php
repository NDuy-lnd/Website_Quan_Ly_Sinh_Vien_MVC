<?php
require_once __DIR__ . '/../models/BieuDoModel.php';

class BieuDoController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new BieuDoModel();
    }

    public function index()
    {
        $lop_id = $_GET['lop'] ?? '';

        $data = [];
        $data['lop'] = $this->model->getAllLop();
        $data['selectedLop'] = $lop_id;

        if ($lop_id) {
            $data['gpa'] = $this->model->getGpaByLop($lop_id)->fetch_all(MYSQLI_ASSOC);
            $data['trangthai'] = $this->model->getTrangThaiByLop($lop_id)->fetch_all(MYSQLI_ASSOC);
        }

        $this->view("bieudo/index", $data);
    }
}
