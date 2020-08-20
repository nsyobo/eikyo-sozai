<?php

try {

    $user = "ここにユーザー名が入ります";
    $password = "ここにパスワードが入ります";

    $dbh = new PDO("mysql:host=localhost; dbname=test_db6; charset=utf8", "$user", "$password");       

    $stmt = $dbh->query('SELECT * FROM users');

    $result = 0;

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
          echo 'エラーが発生しました。:' . $e->getMessage();
}

?>
 <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>簡易掲示板</title>
  </head>
  <body> 
      <h2>簡易掲示板</h2>
        <?php
            echo "<table>\n";
              echo "<tr>\n";
              echo "<th>お名前</th><th>メッセージ</th>\n";
              echo "</tr>\n";
              foreach ($result as $user) {
                echo "<tr>\n";
                echo "<td>" . $user["name"] . "</td>\n";
                echo "<td>" . $user["message"] . "</td>\n";
                echo "<td>\n";
                echo "<a href=edit.php?id=" . $user["id"] . ">編集</a>\n";
                echo "</td>\n";
                echo "</tr>\n";
              }
            echo "</table>\n";
        ?>
  </body>
</html>
