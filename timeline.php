<?php
// p.txt を開く
$filename = 'p.txt';
$user_drink_totals = []; // ユーザーごとの合計飲料量を保存する配列

if (file_exists($filename)) {
    $file = fopen($filename, 'r'); // 読み込みモードで開く

    while (($line = fgets($file)) !== false) {
        // p.txt のデータ形式: ユーザーID, 飲み物名, 飲料量, タグ, コメント, 公開設定, 経過時間設定
        list($userID, $drinkName, $drinkAmount, $tags, $comment, $checkPrivate, $checkDisabled) = explode(',', trim($line));

        // 非公開の投稿はスキップ
        if ($checkPrivate === 'private') {
            continue;
        }

        // 飲料量を整数に変換
        $drinkAmount = (int)$drinkAmount;

        // ユーザーごとの飲料量を集計
        if (!isset($user_drink_totals[$userID])) {
            $user_drink_totals[$userID] = 0;
        }
        $user_drink_totals[$userID] += $drinkAmount;
    }
    fclose($file);
}

// ランキング用に降順ソート
arsort($user_drink_totals);

// ランキングを表示
echo "<h3>飲料量ランキング</h3>";
echo "<table border='1'>";
echo "<tr><th>順位</th><th>ユーザーID</th><th>総飲料量</th></tr>";

$rank = 1;
foreach ($user_drink_totals as $userID =&gt; $totalAmount) {
    echo "<tr><td>$rank</td><td>$userID</td><td>$totalAmount ml</td></tr>";
    $rank++;
}
echo "</table>";
?>