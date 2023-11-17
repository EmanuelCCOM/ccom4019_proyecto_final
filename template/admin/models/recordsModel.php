<?php
class StudentsModel {
    public static function getStudentsByPage($conn, $page, $perPage) {
        $offset = ($page - 1) * $perPage;
        $sql = "SELECT student_id, name, lastName, year_of_study FROM student LIMIT $perPage OFFSET $offset";
        $result = $conn->query($sql);

        if ($result) {
            $students = $result->fetch_all(MYSQLI_ASSOC);
            return $students;
        } else {
            die("Error en la consulta: " . $conn->error);
        }
    }

    public static function getTotalStudents($conn) {
        $sql = "SELECT COUNT(*) as total FROM student";
        $result = $conn->query($sql);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['total'];
        } else {
            die("Error en la consulta: " . $conn->error);
        }
    }
}
?>