<?php
require_once __DIR__ . '/../core/Database.php';

class HocPhanNoModel
{
    // Lấy danh sách lớp
    public static function getClasses()
    {
        $db = Database::connect();
        return $db->query("SELECT id, tenlop FROM lop");
    }

    // Lấy học phần nợ (có / không theo lớp)
    public static function getByClass($lop_id = '')
    {
        $db = Database::connect();

        if ($lop_id != '') {
            $stmt = $db->prepare("
                SELECT 
                    sv.hovaten,
                    l.tenlop,
                    mh.ten_mon,
                    bd.diem_he4,
                    bd.diem_chu
                FROM bangdiem bd
                JOIN sinhvien sv ON bd.sinhvien_id = sv.id
                JOIN lop l ON sv.lop_id = l.id
                JOIN monhoc mh ON bd.monhoc_id = mh.id
                WHERE (bd.diem_he4 < 2 OR bd.diem_chu = 'F')
                  AND sv.lop_id = ?
            ");
            $stmt->bind_param("i", $lop_id);
        } else {
            $stmt = $db->prepare("
                SELECT 
                    sv.hovaten,
                    l.tenlop,
                    mh.ten_mon,
                    bd.diem_he4,
                    bd.diem_chu
                FROM bangdiem bd
                JOIN sinhvien sv ON bd.sinhvien_id = sv.id
                JOIN lop l ON sv.lop_id = l.id
                JOIN monhoc mh ON bd.monhoc_id = mh.id
                WHERE bd.diem_he4 < 2 OR bd.diem_chu = 'F'
            ");
        }

        $stmt->execute();
        return $stmt->get_result();
    }
}
