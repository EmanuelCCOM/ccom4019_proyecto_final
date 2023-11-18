<?php
session_start();

require_once '../models/recordsModel.php';

if (!(isset($_SESSION['role']) && $_SESSION['role'] === 'admin')) {
    // La sesión no está iniciada o el usuario no tiene el rol de administrador, redirige a la página de inicio de sesión
    header("Location: ../../");
    exit();
} else {
    require_once '../db_connect.php';

    $recordController = new recordController();

    // Obtén la página actual desde la URL
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    // Número de estudiantes por página
    $perPage = 5;

    // Obtén los estudiantes de la página actual y el total de estudiantes
    list($students, $totalStudents) = $recordController->getStudentsByPage($conn, $page, $perPage);

    // Llamar a la vista y pasar los datos de los estudiantes
    include '../views/recordsView.php';
}

class recordController {
    public function getStudentsByPage($conn, $page, $perPage) {
        $students = StudentsModel::getStudentsByPage($conn, $page, $perPage);
        $totalStudents = StudentsModel::getTotalStudents($conn); // Nueva función en el modelo
        return array($students, $totalStudents);
    }
}
?>