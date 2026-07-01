<?php
class Export
{
    public static function studentScore($lop_id = '')
    {
        $db = Database::connect();

        $sql = "
            SELECT
                sv.msv,
                sv.hovaten,
                l.tenlop,
                mh.ten_mon,
                bd.diem_chuyencan,
                bd.diem_giua_ky,
                bd.diem_cuoi_ky,
                bd.diem_ren_luyen,
                bd.diem_he4 AS gpa
            FROM sinhvien sv
            JOIN lop l ON sv.lop_id = l.id
            JOIN bangdiem bd ON sv.id = bd.sinhvien_id
            JOIN monhoc mh ON bd.monhoc_id = mh.id
        ";

        // 👉 Nếu chọn lớp cụ thể
        if (!empty($lop_id)) {
            $sql .= " WHERE sv.lop_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("i", $lop_id);
            $stmt->execute();
            return $stmt->get_result();
        }

        // 👉 Xuất tất cả lớp
        return $db->query($sql);
    }
}
