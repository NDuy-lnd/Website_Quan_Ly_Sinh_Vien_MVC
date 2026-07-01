<?php
class Student
{
    public static function getAll()
    {
        $db = Database::connect();
        $sql = "
            SELECT 
                sv.id,
                sv.msv,
                sv.hovaten,
                sv.ngaysinh,
                sv.gioitinh,
                sv.diachi,
                sv.gpa,
                sv.trangthai,
                l.tenlop AS tenlop
            FROM sinhvien sv
            JOIN lop l ON sv.lop_id = l.id
            ORDER BY sv.id DESC
        ";
        return $db->query($sql);
    }
    public static function existsMSV($msv)
    {
        $db = Database::connect();
        $sql = "SELECT id FROM sinhvien WHERE msv = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("s", $msv);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }
    public static function deleteById($id)
    {
        $db = Database::connect();

        // Xóa bảng điểm trước
        $stmt1 = $db->prepare("DELETE FROM bangdiem WHERE sinhvien_id = ?");
        $stmt1->bind_param("i", $id);
        $stmt1->execute();

        // Xóa sinh viên
        $stmt2 = $db->prepare("DELETE FROM sinhvien WHERE id = ?");
        $stmt2->bind_param("i", $id);

        return $stmt2->execute();
    }



    public static function insert($data)
    {
        $db = Database::connect();

        $sql = "
        INSERT INTO sinhvien
        (msv, hovaten, ngaysinh, gioitinh, diachi, dienthoai, trangthai, lop_id)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ";

        $stmt = $db->prepare($sql);

        $stmt->bind_param(
            "sssssssi",
            $data['msv'],
            $data['hovaten'],
            $data['ngaysinh'],
            $data['gioitinh'],
            $data['diachi'],
            $data['dienthoai'],
            $data['trangthai'],
            $data['lop_id']
        );

        return $stmt->execute();
    }

    public static function update($data)
    {
        $db = Database::connect();

        $sql = "UPDATE sinhvien 
            SET msv=?, hovaten=?, ngaysinh=?, gioitinh=?, diachi=?, dienthoai=?, trangthai=?, lop_id=?
            WHERE id=?";

        $stmt = $db->prepare($sql);
        $stmt->bind_param(
            "sssssssii",
            $data['msv'],
            $data['hovaten'],
            $data['ngaysinh'],
            $data['gioitinh'],
            $data['diachi'],
            $data['dienthoai'],
            $data['trangthai'],
            $data['lop_id'],
            $data['id']
        );

        return $stmt->execute();
    }





    public static function getByClass($lop_id)
    {
        $db = Database::connect();
        $sql = "
            SELECT 
                sv.id,
                sv.msv,
                sv.hovaten,
                sv.ngaysinh,
                sv.gioitinh,
                sv.diachi,
                sv.gpa,
                sv.trangthai,
                l.tenlop AS tenlop
            FROM sinhvien sv
            JOIN lop l ON sv.lop_id = l.id
            WHERE sv.lop_id = ?
        ";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $lop_id);
        $stmt->execute();
        return $stmt->get_result();
    }
    public static function findById($id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM sinhvien WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }


    public static function search($keyword, $lop_id = '')
    {
        $db = Database::connect();
        $keyword = "%" . $keyword . "%";

        if ($lop_id != '') {
            $sql = "
                SELECT 
                    sv.id,
                    sv.msv,
                    sv.hovaten,
                    sv.ngaysinh,
                    sv.gioitinh,
                    sv.diachi,
                    sv.gpa,
                    sv.trangthai,
                    l.tenlop AS tenlop
                FROM sinhvien sv
                JOIN lop l ON sv.lop_id = l.id
                WHERE sv.lop_id = ?
                AND (sv.msv LIKE ? OR sv.hovaten LIKE ?)
            ";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("iss", $lop_id, $keyword, $keyword);
        } else {
            $sql = "
                SELECT 
                    sv.id,
                    sv.msv,
                    sv.hovaten,
                    sv.ngaysinh,
                    sv.gioitinh,
                    sv.diachi,
                    sv.gpa,
                    sv.trangthai,
                    l.tenlop AS tenlop
                FROM sinhvien sv
                JOIN lop l ON sv.lop_id = l.id
                WHERE sv.msv LIKE ? OR sv.hovaten LIKE ?
            ";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("ss", $keyword, $keyword);
        }

        $stmt->execute();
        return $stmt->get_result();
    }
    
}
