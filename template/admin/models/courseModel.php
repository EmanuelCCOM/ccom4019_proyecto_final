<?php
class CourseModel {
    public static function getCourseInfoModel($courseId, $conn) {
        // Lógica para obtener la información completa del estudiante desde la base de datos
        // Utiliza $conn para la conexión a la base de datos
        // ...

        // Ejemplo de consulta (ajusta según tu base de datos):
        $query = "SELECT * FROM course WHERE course_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $courseId);
        $stmt->execute();

        // Obtener el resultado de la consulta
        $result = $stmt->get_result()->fetch_assoc();

        return $result;
    }
    public static function updateCourseModel($courseId, $title, $credits, $conn) {
        try {
            // Preparar la consulta SQL con marcadores de posición
            $sql = "UPDATE course SET title = ?, credits = ? WHERE course_id = ?";
        
            // Preparar la declaración
            $stmt = $conn->prepare($sql);
        
            // Ejecutar la consulta con los valores directamente en execute
            $stmt->execute([$title, $credits, $courseId]);
    
        } catch (mysqli_sql_exception $e) {
            echo "Error al actualizar el curso: " . $e->getMessage();
        }
    }            
}
?>
