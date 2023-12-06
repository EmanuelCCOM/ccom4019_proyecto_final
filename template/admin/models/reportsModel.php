<?php
class ReportsModel {
    public static function getTotalStudentModel($conn) {
        try {
            $query = "SELECT COUNT(DISTINCT student_id) AS total_students FROM student";
            $result = $conn->query($query);
    
            if ($result) {
                $row = $result->fetch_assoc();
                return $row['total_students'];
            } else {
                // Manejar el error si la consulta no se ejecuta correctamente
                return false;
            }
        } catch (Exception $e) {
            // Manejar excepciones, si es necesario
            return false;
        }
    }
    
    
}
?>
