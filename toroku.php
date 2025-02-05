<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // データベース接続
    include 'db.php';
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $password]);
    echo "登録が完了しました！";
}
?>
<form method="POST">
    ユーザー名: <input type="text" name="username" required><br>
    パスワード: <input type="password" name="password" required><br>
    <button type="submit">登録</button>
</form>
