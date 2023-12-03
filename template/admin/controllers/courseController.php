<?php
session_start();

require_once '../models/courseModel.php';

if (!(isset($_SESSION['role']) && $_SESSION['role'] === 'admin')) {
    // La sesión no está iniciada o el usuario no tiene el rol de administrador, redirige a la página de inicio de sesión
    header("Location: ../../");
    exit();
} else {
    require_once '../db_connect.php';
    $courseObj = new courseController();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])) {
        $action = $_POST["action"];

        switch ($action) {
            case "viewCourse":
                // Obtener el ID del estudiante
                $courseId = $_POST['course_id'];

                // Obtener la información completa del estudiante desde el modelo
                $courseInfo = $courseObj->getCourseInfoController($courseId, $conn);

                // Cargar la vista para mostrar la información completa del estudiante
                include '../views/courseView.php';
                break;

            case "updateCourse":
                // Lógica para actualizar la información del curso
                $courseId = $_POST['courseId'];
                $title = $_POST['titulo'];
                $credits = $_POST['creditos'];

                $result = $courseObj->updateCourseController($courseId, $title, $credits, $conn);
                $courseInfo = $courseObj->getCourseInfoController($courseId, $conn);
                include '../views/courseView.php';
                break;

            default:
                header("Location: recordsController.php");
                break;
        }
    } else {
        header("Location: classesController.php");
    }
}

class courseController {
    public function getCourseInfoController($courseId, $conn) {
        // Lógica para obtener la información completa del estudiante desde el modelo
        $course = CourseModel::getCourseInfoModel($courseId, $conn);
        return $course;
    }

    public function updateCourseController($courseId, $title, $credits, $conn) {
        // Lógica para obtener la información completa del estudiante desde el modelo
        $result = CourseModel::updateCourseModel($courseId, $title, $credits, $conn);
        return $result;
    }
}
?>
