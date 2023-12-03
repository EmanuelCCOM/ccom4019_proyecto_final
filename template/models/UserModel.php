<?php
class UserModel {
    public static function getUserByEmail($email) {
        // Conecta a la base de datos usando el archivo db_connect.php
        require_once '../db_connect.php';

        // Verificar si el usuario es un admin
        $sql = "SELECT * FROM admins WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $user['role'] = 'admin';
            return $user;
        }

        // Si no es un admin, verificar si es un estudiante
        $sql = "SELECT * FROM student WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $user['role'] = 'student';
            return $user;
        }

        return null;
    }
}
?>
