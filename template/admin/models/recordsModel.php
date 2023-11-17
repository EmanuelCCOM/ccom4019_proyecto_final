<?php
class StudentsModel {
    public static function getStudents($conn) {
        // Consulta SQL para obtener solo los atributos necesarios de todos los estudiantes
        $sql = "SELECT student_id, name, lastName, year_of_study FROM student";
        $result = $conn->query($sql);

        // Verificar si la consulta fue exitosa
        if ($result) {
            $students = $result->fetch_all(MYSQLI_ASSOC);

            return $students;
        } else {
            // Manejar el error de la consulta (puedes personalizar esto según tus necesidades)
            die("Error en la consulta: " . $conn->error);
        }
    }
}
?>
