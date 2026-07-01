<?php
require_once "../app/models/Notification.php";

class NotificationController extends Controller
{
    //Thay thế hàm index(11/1)--

    public function index()
    {
        require_once '../app/models/Notification.php';
        require_once '../app/models/LopModel.php';

        $lop = $_GET['lop'] ?? '';

        $notifications = Notification::getByClass($lop);
        $classes = LopModel::getAll();

        require_once '../app/views/notification/index.php';
    }



    public function add()
    {
        require_once "../app/models/LopModel.php";
        $lopModel = new LopModel();

        $this->view('notification/addthongbao', [
            'title' => 'THÊM THÔNG BÁO MỚI',
            'item'  => null,
            'dslop' => $lopModel->getAll()
        ]);
    }
    // thay bang hàm này 11/1
    public function edit($id)
    {
        require_once "../app/models/Notification.php";
        require_once "../app/models/LopModel.php";

        // Lấy thông báo cũ
        $item = Notification::find($id);

        if (!$item) {
            die("Thông báo không tồn tại");
        }

        // Lấy danh sách lớp
        $dslop = LopModel::getAll();

        // DÙNG CHUNG FORM
        $this->view('notification/addthongbao', [
            'title' => 'SỬA THÔNG BÁO',
            'item'  => $item,
            'dslop' => $dslop
        ]);
    }



    public function save()
    {
        require_once "../app/models/Notification.php";

        if (!empty($_POST['id'])) {
            // SỬA
            Notification::update($_POST['id'], $_POST);
        } else {
            // THÊM
            Notification::insert($_POST);
        }

        echo json_encode([
            'status' => 'success'
        ]);
        exit;
    }

    // thay bằng hàm này 11/1
    public function delete($id)
    {
        require_once "../app/models/Notification.php";

        Notification::delete($id);

        // quay lại trang danh sách
        header("Location: /QuanLySinhVienMVC/public/notification/index");
        exit;
    }

    public function search()
    {
        require_once '../app/models/Notification.php';
        require_once '../app/models/LopModel.php';

        $tieude = $_GET['tieude'] ?? '';
        $lop = $_GET['lop'] ?? '';

        $notifications = Notification::search($tieude, $lop);
        $classes = LopModel::getAll();
        $selectedLop = $lop;

        require_once '../app/views/notification/index.php';
    }
}
