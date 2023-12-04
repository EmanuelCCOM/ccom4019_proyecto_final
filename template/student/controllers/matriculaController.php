<?php
session_start();

require_once '../models/matriculaModel.php';

if (!(isset($_SESSION['role']) && $_SESSION['role'] === 'student')) {
    // La sesión no está iniciada o el usuario no tiene el rol de estudiante, redirige a la página de inicio de sesión
    header("Location: ../../");
    exit();
} else {
    require_once '../db_connect.php';

    $enrollmentController = new EnrollmentController();

    // Obtén la página actual desde la URL
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    // Número de cursos por página
    $perPage = 10;

    // Obtén el término de búsqueda si existe
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

    // Obtén los cursos de la página actual y el total de cursos
    list($enrollments, $totalEnrollments) = $enrollmentController->getEnrollmentsByPage($conn, $page, $perPage, $searchTerm);

    // Llamar a la vista y pasar los datos de las matrículas
    include '../views/cursosMatriculados.php'; // Assuming you have a 'cursosMatriculados.php' view file
}

class EnrollmentController {
    public function getEnrollmentsByPage($conn, $page, $perPage, $searchTerm) {
        $enrollments = EnrollmentModel::getEnrollmentsByPage($conn, $page, $perPage, $searchTerm);
        $totalEnrollments = EnrollmentModel::getTotalEnrollments($conn, $searchTerm);
        return array($enrollments, $totalEnrollments);
    }
}
?>