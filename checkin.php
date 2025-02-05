<?php
// フォームデータを取得
$drinkName = $_POST['drinkName'];  // 飲み物の名前
$tags = $_POST['tags'];            // タグ
$comment = $_POST['example'];      // コメント
$drinkAmount = $_POST['drinkAmount']; // 飲料量
$checkPrivate = isset($_POST['checkProvate']) ? 'private' : 'public'; // 非公開設定
$checkDisabled = isset($_POST['checkDisabled']) ? 'disabled' : 'enabled'; // 経過時間記録設定

// ユーザーIDをセッションなどから取得（例として仮のIDを使用）
$userID = 'user123';  // 仮のユーザーID

// p.txtに保存するための内容を作成
$line = "$userID, $drinkName, $drinkAmount, $tags, $comment, $checkPrivate, $checkDisabled\n";

// p.txtファイルに保存
$file = fopen('p.txt', 'a');  // 'a'モードで開く（追記）
if ($file) {
    fwrite($file, $line);  // ファイルに書き込む
    fclose($file);         // ファイルを閉じる
} else {
    echo "ファイルの書き込みに失敗しました。";
}

// フォーム送信後のリダイレクト
header('Location: timeline.html');  // チェックイン後にタイムラインに戻る
exit();
?>
