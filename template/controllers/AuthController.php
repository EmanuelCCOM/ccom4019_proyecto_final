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

        if (password_verify($password, $user['pass'])) // Las credenciales son correctas, el usuario está autenticado
        {
            // Inicia la sesión
            session_start();
            // Establece la variable de sesión $role
            $_SESSION['role'] = "admin";

            // Redirige al usuario a la página "expedientes.php"
            header("Location: ../admin/controllers/recordsController.php");
            exit(); // Termina el script para evitar que se siga ejecutando
        } else
        {
            // Las credenciales son incorrectas, redirige de nuevo a "index.php"
            header("Location: ../");
            exit();
        }
    }
}
?>
