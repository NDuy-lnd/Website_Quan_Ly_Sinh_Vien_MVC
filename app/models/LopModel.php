<?php
require_once __DIR__ . '/../core/Database.php';

class LopModel
{
    public static function getAllWithKhoa($keyword = '')
    {
        $conn = Database::connect();

        if ($keyword !== '') {
            $stmt = $conn->prepare("
                SELECT lop.id, lop.tenlop, khoa.tenkhoa
                FROM lop
                JOIN khoa ON lop.khoa_id = khoa.id
                WHERE lop.tenlop LIKE ?
            ");
            $like = "%$keyword%";
            $stmt->bind_param("s", $like);
            $stmt->execute();
            return $stmt->get_result();
        }

        return $conn->query("
            SELECT lop.id, lop.tenlop, khoa.tenkhoa
            FROM lop
            JOIN khoa ON lop.khoa_id = khoa.id
        ");
    }

    public static function insert($tenlop, $khoa_id)
    {
        $conn = Database::connect();
        $stmt = $conn->prepare("INSERT INTO lop(tenlop, khoa_id) VALUES (?, ?)");
        $stmt->bind_param("si", $tenlop, $khoa_id);
        return $stmt->execute();
    }
    public static function getAll()
    {
        $conn = Database::connect();
        $sql = "SELECT id, tenlop FROM lop";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function deleteById($id)
    {
        $conn = Database::connect();
        $stmt = $conn->prepare("DELETE FROM lop WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
