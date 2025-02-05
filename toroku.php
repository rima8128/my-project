<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // p.txtファイルのパス
    $pfile = 'p.txt';
    
    // ファイルが存在しない場合は作成
    if (!file_exists($pfile)) {
        touch($pfile);
    }
    
    // p.txtからデータを読み込んで、既存のユーザー名がないか確認
    $lines = file($pfile);
    foreach ($lines as $line) {
        $line = chop($line);  // 改行を削除
        $user_data = explode(",", $line);  // ユーザー名とパスワードをカンマで分割
        if ($user_data[0] == $username) {
            $error_message = "そのユーザー名はすでに登録されています。";
            break;
        }
    }

    // 新しいユーザー情報をp.txtに追加
    if (!isset($error_message)) {
        $fp = fopen($pfile, 'a');
        fputs($fp, $username . "," . $password . "\r\n");  // ユーザー名とハッシュ化したパスワードをカンマで保存
        fclose($fp);
        $success_message = "登録が完了しました！";
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー登録</title>
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
        .register-container {
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
        .message {
            text-align: center;
            font-weight: bold;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
    </style>
</head>
<body>

    <div class="register-container">
        <h2>ユーザー登録</h2>

        <!-- エラーメッセージがある場合は表示 -->
        <?php if (isset($error_message)): ?>
            <p class="message error"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <!-- 成功メッセージがある場合は表示 -->
        <?php if (isset($success_message)): ?>
            <p class="message success"><?php echo $success_message; ?></p>
        <?php endif; ?>

        <form method="POST">
            <label for="username">ユーザー名:</label><br>
            <input type="text" class="input-field" name="username" required><br>

            <label for="password">パスワード:</label><br>
            <input type="password" class="input-field" name="password" required><br>

            <button type="submit" class="submit-btn">登録</button>
        </form>

    </div>

</body>
</html>
