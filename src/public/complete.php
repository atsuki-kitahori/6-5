<?php
// POSTデータを受け取る
$name = isset($_POST['name'])
    ? htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8')
    : '';
$food_awnser = isset($_POST['food_awnser'])
    ? htmlspecialchars($_POST['food_awnser'], ENT_QUOTES, 'UTF-8')
    : '';
$hobby_awnser = isset($_POST['hobby_awnser'])
    ? htmlspecialchars($_POST['hobby_awnser'], ENT_QUOTES, 'UTF-8')
    : '';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>送信完了</title>
</head>
<body>
    <h1>送信完了</h1>
    <p>以下の内容で送信されました：</p>
    <ul>
        <li>名前: <?php echo $name; ?></li>
        <li>好きな食べ物: <?php echo $food_awnser; ?></li>
        <li>メッセージ: <?php echo $hobby_awnser; ?></li>
    </ul>
    <a href="index.php">トップページに戻る</a>
</body>
</html>
