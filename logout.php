<?php
session_start();
session_destroy();  // セッションを破棄

// HTML部分を表示
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="3;url=login.php"> <!-- 3秒後にlogin.phpへリダイレクト -->
    <title>ログアウト</title>
</head>
<body>
    <p>ログアウトしました。</p>
    <p>3秒後にログイン画面にリダイレクトされます。</p>
</body>
</html>
<?php
// 上記のHTMLが表示された後、3秒経過で自動的にlogin.phpへリダイレクトされます。
?>
