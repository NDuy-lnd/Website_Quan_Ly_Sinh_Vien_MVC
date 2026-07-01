<?php
class User {

    public static function findByEmail($email) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function updatePassword($email, $password) {
    $db = Database::connect();
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $db->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $hash, $email);
    return $stmt->execute();
}

}
?>