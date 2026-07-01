<?php
class Notification
{

    public static function getAll()
    {
        $db = Database::connect();
        $sql = "SELECT * FROM thongbao ORDER BY ngaydang DESC";
        return mysqli_query($db, $sql);
    }

    public static function insert($data)
    {
        $db = Database::connect();
        $sql = "INSERT INTO thongbao (tieude, noidung, loaitin, lop) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);

        $tieude = $data['tieude'] ?? '';
        $noidung = $data['noidung'] ?? '';
        $loaitin = $data['loaitin'] ?? 'Thông báo chung';
        $lop = $data['lop'] ?? 'Tất cả';

        $stmt->bind_param("ssss", $tieude, $noidung, $loaitin, $lop);
        $result = $stmt->execute();

        if (!$result) {
            die("Lỗi SQL: " . $db->error);
        }
        return $result;
    }

    public static function find($id)
    {
        $db = Database::connect();
        $sql = "SELECT * FROM thongbao WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function update($id, $data)
    {
        $db = Database::connect();
        $sql = "UPDATE thongbao
                SET tieude=?, noidung=?, loaitin=?, lop=?
                WHERE id=?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param(
            "ssssi",
            $data['tieude'],
            $data['noidung'],
            $data['loaitin'],
            $data['lop'],
            $id
        );
        return $stmt->execute();
    }

    public static function delete($id)
    {
        $db = Database::connect();
        $sql = "DELETE FROM thongbao WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }


    //thêm hàm này 11/1--
    public static function getByClass($lop)
    {
        $db = Database::connect();

        if ($lop === '' || $lop === null) {
            $sql = "SELECT * FROM thongbao ORDER BY ngaydang DESC";
            return mysqli_query($db, $sql);
        }

        $sql = "SELECT * FROM thongbao WHERE lop = ? ORDER BY ngaydang DESC";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("s", $lop);
        $stmt->execute();
        return $stmt->get_result();
    }
    // thêm hàm này 11/1
    public static function search($tieude, $lop)
    {
        $db = Database::connect();

        $sql = "SELECT * FROM thongbao WHERE 1=1";
        $params = [];
        $types = "";

        if ($tieude !== '') {
            $sql .= " AND tieude LIKE ?";
            $params[] = "%" . $tieude . "%";
            $types .= "s";
        }

        if ($lop !== '') {
            $sql .= " AND lop = ?";
            $params[] = $lop;
            $types .= "s";
        }

        $sql .= " ORDER BY ngaydang DESC";

        $stmt = $db->prepare($sql);

        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        return $stmt->get_result();
    }
}
