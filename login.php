<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    include 'db.php';
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: board.php");
    } else {
        echo "���O�C���Ɏ��s���܂����B";
    }
}
?>
<form method="POST">
    ���[�U�[��: <input type="text" name="username" required><br>
    �p�X���[�h: <input type="password" name="password" required><br>
    <button type="submit">���O�C��</button>
</form>
