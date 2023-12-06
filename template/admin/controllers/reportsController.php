<?php
session_start();

require_once '../models/reportsModel.php';

if (!(isset($_SESSION['role']) && $_SESSION['role'] === 'admin')) {
    // La sesión no está iniciada o el usuario no tiene el rol de administrador, redirige a la página de inicio de sesión
    header("Location: ../../");
    exit();
} else {
    require_once '../db_connect.php';
    $reports = new reportsController();

    $totalStudents = $reports->getStudentTotal($conn);
    include '../views/reportsView.php';
}

class reportsController {
    public function getStudentTotal($conn) {
        $results = ReportsModel::getTotalStudentModel($conn);
        return $results;
    }
}
?>
