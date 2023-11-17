<?php
session_start();

require_once '../models/recordsModel.php';

if (!(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'))
{
    // La sesión no está iniciada o el usuario no tiene el rol de administrador, redirige a la página de inicio de sesión
    header("Location: ../../");
    exit();
}
else
{
    require_once '../db_connect.php';

    $recordController = new recordController();
    $students = $recordController->getStudents($conn);

    // Llamar a la vista y pasar los datos de los estudiantes
    include '../views/recordsView.php';
}

class recordController
{
    public function getStudents($conn)
    {
        // Llamada al modelo que retorna la información de todos los estudiantes
        $students = StudentsModel::getStudents($conn);
        return $students;
    }
}
?>
