<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // p.txtファイルのパス
    $pfile = 'p.txt';

    // p.txtからデータを読み込んで、ユーザー情報を確認
    $lines = file($pfile);
    $user_found = false;
    foreach ($lines as $line) {
        $line = chop($line);  // 改行を削除
        $user_data = explode(",", $line);  // ユーザー名とパスワードをカンマで分割

        // ユーザー名が一致した場合
        if ($user_data[0] == $username) {
            $user_found = true;

            // パスワードを照合
            if (password_verify($password, $user_data[1])) {
                $_SESSION['username'] = $username;  // セッションにユーザー名を保存
                header("Location: board.php");  // board.phpにリダイレクト
                exit;
            } else {
                $error_message = "パスワードが間違っています。";
                break;
            }
        }
    }

    // ユーザーが見つからなかった場合
    if (!$user_found) {
        $error_message = "ユーザーが見つかりません。";
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2 {
            text-align: center;
        }
        .input-field {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .submit-btn {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>ログイン</h2>

        <!-- エラーメッセージがある場合は表示 -->
        <?php if (isset($error_message)): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form method="POST">
            <label for="username">ユーザー名:</label><br>
            <input type="text" class="input-field" name="username" required><br>

            <label for="password">パスワード:</label><br>
            <input type="password" class="input-field" name="password" required><br>

            <button type="submit" class="submit-btn">ログイン</button>
        </form>

    </div>

</body>
</html>
