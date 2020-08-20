<?php

try {

    $user = "ここにユーザー名が入ります";
    $password = "ここにパスワードが入ります";

    $dbh = new PDO("mysql:host=localhost; dbname=test_db6; charset=utf8", "$user", "$password");

    $stmt = $dbh->prepare('SELECT * FROM users WHERE id = :id');

    $stmt->execute(array(':id' => $_GET["id"]));

    $result = 0;

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

} catch (Exception $e) {
          echo 'エラーが発生しました。:' . $e->getMessage();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>編集</title>

    <div class="contact-form">
        <h2>編集</h2>
        <form action="update.php" method="post">
                <input type="hidden" name="id" value="<?php if (!empty($result['id'])) echo(htmlspecialchars($result['id'], ENT_QUOTES, 'UTF-8'));?>">
            <p>
                <label>お名前：</label>
                <input type="text" name="name" value="<?php if (!empty($result['name'])) echo(htmlspecialchars($result['name'], ENT_QUOTES, 'UTF-8'));?>">
            </p>
            <p>
                <label>メッセージ：</label>
                <input type="text" name="message" value="<?php if (!empty($result['message'])) echo(htmlspecialchars($result['message'], ENT_QUOTES, 'UTF-8'));?>">
            </p>

            <input type="submit" value="編集する">

        </form>
    </div>
        <a href="index.php">投稿一覧へ</a>
</body>
</html>