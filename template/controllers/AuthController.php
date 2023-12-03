<?php
require_once '../models/UserModel.php';

// Verifica si el formulario se ha enviado usando el método POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $authController = new AuthController();
    $authController->login();
} else {
    // Si el método no es POST, redirige al usuario a la página de inicio
    header("Location: ../");
    exit();
}

class AuthController
{
    public function login()
    {
        // Obtener los valores del form en el index.php osea el login
        $email = $_POST["email"];
        $password = $_POST["password"];

        // llamada al model que regresa la contrasena del usuario con el email proveido.
        $user = UserModel::getUserByEmail($email);

        //SE UTILIZO PARA DEBUGGING
        //$archivoRegistro = __DIR__ . '/archivo_de_registro.txt';
        //error_log("Contrasena introducida en el form: " . $password . "\n", 3, $archivoRegistro);
        //error_log("Contrasena en la base de datos: " . $user['pass'] . "\n", 3, $archivoRegistro);
        $_SESSION['role'] = $user['role'];
        if ($user['role'] == "admin") {
            $_SESSION['role'] = 'admin';
            header("Location: ../admin/controllers/recordsController.php");
        } elseif ($user['role'] == "student") {
            $_SESSION['role'] = 'student';
            header("Location: ../student/controllers/coursesController.php");
        } else {
            // Handle other roles or redirect to a default page
            header("Location: ../");
        }
       
        exit();
    } 
}

?>
