<?php
require_once __DIR__ . '/../models/LopModel.php';
require_once __DIR__ . '/../models/KhoaModel.php';

class LopController extends Controller
{
    public function index()
    {
        $khoa = KhoaModel::getAll();
        $alert = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // 👉 THÊM LỚP
            if ($_POST['action'] === 'add') {

                $tenlop = trim($_POST['tenlop_add'] ?? '');
                $khoa_id = $_POST['khoa_id'] ?? '';

                if ($tenlop !== '' && $khoa_id !== '') {
                    LopModel::insert($tenlop, $khoa_id);
                    $alert = "✅ Thêm lớp thành công!";
                } else {
                    $alert = "❌ Vui lòng nhập tên lớp!";
                }

                // Load lại toàn bộ lớp
                $lop = LopModel::getAllWithKhoa();
            }

            // 👉 TÌM KIẾM
            elseif ($_POST['action'] === 'search') {
                $keyword = trim($_POST['tenlop_search'] ?? '');
                $lop = LopModel::getAllWithKhoa($keyword);
            }
        } else {
            $lop = LopModel::getAllWithKhoa();
        }

        $this->view('lop/index', [
            'khoa'  => $khoa,
            'lop'   => $lop,
            'alert' => $alert
        ]);
    }

    public function delete($id)
    {
        // Có thể kiểm tra ràng buộc ở đây nếu muốn
        if (LopModel::deleteById($id)) {
            echo "✅ Xóa lớp thành công!";
        } else {
            echo "❌ Không thể xóa lớp!";
        }
    }
}
