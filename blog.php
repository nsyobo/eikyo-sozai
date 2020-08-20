<?php require_once "system/common.php";?>
<?php
// データの問い合わせ
$rows_post = array(); // 配列の初期化
try {
    $stmt = $db->prepare("SELECT * FROM posts ORDER BY post_created DESC");
    $stmt->execute(); // クエリの実行
    $rows_post = $stmt->fetchAll(); // SELECT結果を二次元配列に格納
} catch (PDOException $e) {
    // エラー発生時
    exit("クエリの実行に失敗しました");
}
?>
<?php $page_title = "To You";?>
<?php require "header.php";?>
<?php foreach ($rows_post as $row_post) {;?>
    <article>
      <h2>
        <?php echo he($row_post["post_title"]);?>
      </h2>
      <time>
        <?php echo he($row_post["post_created"]);?>
      </time>
      <p>
        <?php echo nl2br(he($row_post["post_content"]));?>
      </p>
    </article>
<?php }?>
<?php require "footer.php";?>
