<?php
// データベースに接続
$dbUserName = 'root';
$dbPassword = 'password';
try {
    $pdo = new PDO(
        'mysql:host=mysql;dbname=questionnaireform;charset=utf8',
        $dbUserName,
        $dbPassword
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('データベース接続エラー: ' . $e->getMessage());
}

// POSTデータを受け取る
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$food_awnser = isset($_POST['food_awnser']) ? trim($_POST['food_awnser']) : '';
$hobby_awnser = isset($_POST['hobby_awnser'])
    ? trim($_POST['hobby_awnser'])
    : '';

// バリデーションエラー
$errors = [];
if (empty($name)) {
    $errors[] = '名前を入力してください。';
}
if (empty($food_awnser)) {
    $errors[] = '好きな食べ物を入力してください。';
}
if (empty($hobby_awnser)) {
    $errors[] = '趣味を入力してください。';
}

// エラーがない場合のみデータを挿入
if (empty($errors)) {
    try {
        $stmt = $pdo->prepare(
            'INSERT INTO booking (name, food_awnser, hobby_awnser) VALUES (:name, :food_awnser, :hobby_awnser)'
        );
        $stmt->execute([
            ':name' => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
            ':food_awnser' => htmlspecialchars(
                $food_awnser,
                ENT_QUOTES,
                'UTF-8'
            ),
            ':hobby_awnser' => htmlspecialchars(
                $hobby_awnser,
                ENT_QUOTES,
                'UTF-8'
            ),
        ]);
        $success = true;
    } catch (PDOException $e) {
        $errors[] = 'データ挿入エラー: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo empty($errors) ? '送信完了' : 'エラー'; ?></title>
</head>
<body>
    <?php if (!empty($errors)): ?>
        <h1>エラー</h1>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars(
                    $error,
                    ENT_QUOTES,
                    'UTF-8'
                ); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <h1>アンケート完了</h1>
    <?php endif; ?>
    <a href="index.php">アンケート画面へ</a>
</body>
</html>
