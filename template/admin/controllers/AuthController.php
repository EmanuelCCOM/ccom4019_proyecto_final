<?php
require_once '../models/UserModel.php';

// Verifica si el formulario se ha enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $authController = new AuthController();
    $authController->login();
}

class AuthController {
    public function login() {
        // Obtener los valores del formulario
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Consultar la base de datos para verificar las credenciales
        $user = UserModel::getUserByEmail($email);

        if ($user && $password == $user['pass']) {
            // Las credenciales son correctas, el usuario está autenticado
            // Redirige al usuario a la página "expedientes.php"
            header("Location: ../views/expedientes.php");
            exit(); // Termina el script para evitar que se siga ejecutando
        } else {
            // Las credenciales son incorrectas, redirige de nuevo a "index.php"
            header("Location: ../views/index.php");
            exit();
        }
    }
}
?>
