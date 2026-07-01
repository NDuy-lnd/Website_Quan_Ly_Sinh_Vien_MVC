<?php
require_once __DIR__ . '/../core/Database.php';

class KhoaModel
{
    public static function getAll($keyword = '')
    {
        $conn = Database::connect();

        if ($keyword !== '') {
            $stmt = $conn->prepare("SELECT * FROM khoa WHERE tenkhoa LIKE ?");
            $like = "%$keyword%";
            $stmt->bind_param("s", $like);
            $stmt->execute();
            return $stmt->get_result();
        }

        return $conn->query("SELECT * FROM khoa");
    }

    public static function exists($departmentName)
    {
        $conn = Database::connect();
        $stmt = $conn->prepare("SELECT * FROM khoa WHERE tenkhoa = ?");
        $stmt->bind_param("s", $departmentName);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public static function insert($tenkhoa)
    {
        $conn = Database::connect();
        $stmt = $conn->prepare("INSERT INTO khoa(tenkhoa) VALUES (?)");
        $stmt->bind_param("s", $tenkhoa);
        return $stmt->execute();
    }
}
