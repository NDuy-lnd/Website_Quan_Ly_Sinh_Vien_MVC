<?php
require_once __DIR__ . '/../core/Database.php';

class BieuDoModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::connect();
    }

    // Danh sách lớp
    public function getAllLop()
    {
        return $this->conn->query("SELECT id, tenlop FROM lop");
    }

    // GPA theo lớp (phân loại)
    public function getGpaByLop($lop_id)
    {
        $sql = "
            SELECT 
                CASE
                    WHEN gpa >= 3.6 THEN 'Xuất sắc'
                    WHEN gpa >= 3.2 THEN 'Giỏi'
                    WHEN gpa >= 2.5 THEN 'Khá'
                    WHEN gpa >= 2.0 THEN 'Trung bình'
                    ELSE 'Yếu'
                END AS muc,
                COUNT(*) AS tong
            FROM (
                SELECT sv.id,
                       SUM(bd.diem_he4 * mh.so_tin_chi) / SUM(mh.so_tin_chi) AS gpa
                FROM sinhvien sv
                JOIN bangdiem bd ON sv.id = bd.sinhvien_id
                JOIN monhoc mh ON bd.monhoc_id = mh.id
                WHERE sv.lop_id = ?
                GROUP BY sv.id
            ) t
            GROUP BY muc
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $lop_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Trạng thái sinh viên theo lớp
    public function getTrangThaiByLop($lop_id)
    {
        $stmt = $this->conn->prepare("
            SELECT trangthai, COUNT(*) AS tong
            FROM sinhvien
            WHERE lop_id = ?
            GROUP BY trangthai
        ");
        $stmt->bind_param("i", $lop_id);
        $stmt->execute();
        return $stmt->get_result();
    }
}
