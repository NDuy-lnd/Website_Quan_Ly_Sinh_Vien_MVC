<?php
require_once "../app/models/Export.php";

class ExportController extends Controller
{
    public function excel()
    {
        $lop_id = $_GET['lop'] ?? '';
        $data = Export::studentScore($lop_id);

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=bang_diem_sinh_vien.xls");

        echo "<table border='1'>";
        echo "<tr>
            <th>MSV</th>
            <th>Họ tên</th>
            <th>Lớp</th>
            <th>Môn học</th>
            <th>CC</th>
            <th>Giữa kỳ</th>
            <th>Cuối kỳ</th>
            <th>Rèn luyện</th>
            <th>GPA</th>
        </tr>";

        while ($row = $data->fetch_assoc()) {
            echo "<tr>
                <td>{$row['msv']}</td>
                <td>{$row['hovaten']}</td>
                <td>{$row['tenlop']}</td>
                <td>{$row['ten_mon']}</td>
                <td>{$row['diem_chuyencan']}</td>
                <td>{$row['diem_giua_ky']}</td>
                <td>{$row['diem_cuoi_ky']}</td>
                <td>{$row['diem_ren_luyen']}</td>
                <td>{$row['gpa']}</td>
            </tr>";
        }

        echo "</table>";
        exit;
    }
}
