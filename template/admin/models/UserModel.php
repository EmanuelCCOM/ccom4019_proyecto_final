<?php
class UserModel {
    public static function getUserByEmail($email) {
        // Conecta a la base de datos usando el archivo db_connect.php
        require_once '../db_connect.php';

        // Consulta SQL para obtener un usuario por correo electrónico
        $sql = "SELECT * FROM admins WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
}
?>
