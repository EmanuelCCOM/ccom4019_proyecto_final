<?php
session_start();

require_once '../models/coursesModel.php';

if (!(isset($_SESSION['role']) && $_SESSION['role'] === 'student')) {
    // La sesión no está iniciada o el usuario no tiene el rol de estudiante, redirige a la página de inicio de sesión
    header("Location: ../../");
    exit();
} else {
    require_once '../db_connect.php';

    $courseController = new CourseController();

    // Obtén la página actual desde la URL
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    // Número de cursos por página
    $perPage = 1;

    // Obtén los cursos de la página actual y el total de cursos
    list($courses, $totalCourses) = $courseController->getCoursesByPage($conn, $page, $perPage);

    // Llamar a la vista y pasar los datos de los cursos
    include '../views/classes.php'; // Assuming you have a 'courses.php' view file

}

class CourseController {
    public function getCoursesByPage($conn, $page, $perPage) {
        $courses = CoursesModel::getCoursesByPage($conn, $page, $perPage);
        $totalCourses = CoursesModel::getTotalCourses($conn); // Nueva función en el modelo
        return array($courses, $totalCourses);
    }
}
?>