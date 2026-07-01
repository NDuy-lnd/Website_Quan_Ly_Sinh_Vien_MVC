<?php
require_once __DIR__ . '/../core/Database.php';

class BangDiemModel
{
    // Lấy danh sách lớp
    public static function getAllClasses()
    {
        $db = Database::connect();
        return $db->query("SELECT id, tenlop FROM lop");
    }

    // Lấy sinh viên theo lớp
    public static function getStudentsByClass($lop_id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("
            SELECT id, hovaten
            FROM sinhvien
            WHERE lop_id = ?
        ");
        $stmt->bind_param("i", $lop_id);
        $stmt->execute();
        return $stmt->get_result();
    }
    // 🔥 LẤY TOÀN BỘ BẢNG ĐIỂM (TẤT CẢ SINH VIÊN)
    public static function getAllGrades()
    {
        $db = Database::connect();
        return $db->query("
        SELECT 
            sv.hovaten,
            l.tenlop,
            mh.ten_mon,
            bd.diem_chuyencan,
            bd.diem_giua_ky,
            bd.diem_cuoi_ky,
            bd.diem_ren_luyen,
            bd.diem_tong,
            bd.diem_he4,
            bd.diem_chu
        FROM bangdiem bd
        JOIN sinhvien sv ON bd.sinhvien_id = sv.id
        JOIN lop l ON sv.lop_id = l.id
        JOIN monhoc mh ON bd.monhoc_id = mh.id
        ORDER BY l.tenlop, sv.hovaten
    ");
    }


    // 🔥 BẢNG ĐIỂM THEO SINH VIÊN (ĐÚNG CẤU TRÚC)
    public static function getGradesByStudent($sv_id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("
            SELECT 
                mh.ten_mon,
                mh.so_tin_chi,
                bd.diem_chuyencan,
                bd.diem_giua_ky,
                bd.diem_cuoi_ky,
                bd.diem_ren_luyen,
                bd.diem_tong,
                bd.diem_he4,
                bd.diem_chu
            FROM bangdiem bd
            JOIN monhoc mh ON bd.monhoc_id = mh.id
            WHERE bd.sinhvien_id = ?
        ");
        $stmt->bind_param("i", $sv_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 🔥 GPA THEO LỚP (CHUẨN ĐỒ ÁN)
    public static function gpaByClass($lop_id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("
            SELECT 
                sv.hovaten,
                ROUND(
                    SUM(bd.diem_he4 * mh.so_tin_chi) / SUM(mh.so_tin_chi),
                    2
                ) AS gpa
            FROM sinhvien sv
            JOIN bangdiem bd ON sv.id = bd.sinhvien_id
            JOIN monhoc mh ON bd.monhoc_id = mh.id
            WHERE sv.lop_id = ?
              AND bd.diem_he4 > 0
            GROUP BY sv.id
        ");
        $stmt->bind_param("i", $lop_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function getAllSubjects()
    {
        $db = Database::connect();
        return $db->query("SELECT id, ten_mon, so_tin_chi FROM monhoc");
    }

    // Thêm điểm cho sinh viên
    public static function insert($data)
    {
        $db = Database::connect();

        $cc = (float)$data['diem_chuyencan'];
        $gk = (float)$data['diem_giua_ky'];
        $ck = (float)$data['diem_cuoi_ky'];
        $rl = (float)$data['diem_ren_luyen'];

        $diem_tong = round(
            0.1 * $cc +
                0.2 * $gk +
                0.6 * $ck +
                0.1 * $rl,
            2
        );

        if ($diem_tong >= 8.5) {
            $diem_he4 = 4.0;
            $diem_chu = 'A';
        } elseif ($diem_tong >= 7.0) {
            $diem_he4 = 3.0;
            $diem_chu = 'B';
        } elseif ($diem_tong >= 5.5) {
            $diem_he4 = 2.0;
            $diem_chu = 'C';
        } elseif ($diem_tong >= 4.0) {
            $diem_he4 = 1.0;
            $diem_chu = 'D';
        } else {
            $diem_he4 = 0.0;
            $diem_chu = 'F';
        }



        $sql = "
            INSERT INTO bangdiem
            (sinhvien_id, monhoc_id, diem_chuyencan, diem_giua_ky, diem_cuoi_ky, diem_ren_luyen, diem_tong, diem_he4, diem_chu)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ";

        $stmt = $db->prepare($sql);

        // ⚠ demo: monhoc_id tạm để = 1 (sau này bạn tách chọn môn)
        $monhoc_id = (int)$data['monhoc_id'];


        $stmt->bind_param(
            "iidddddds",
            $data['sinhvien_id'],
            $monhoc_id,
            $cc,
            $gk,
            $ck,
            $rl,
            $diem_tong,
            $diem_he4,
            $diem_chu
        );


        return $stmt->execute();
    }
}
