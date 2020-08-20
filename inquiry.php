<?php require_once "system/common.php";?>
<?php
// ホワイトリスト変数の作成
$whitelist = array("send", "uname", "email", "body");
$request = whitelist($whitelist);

$page_message = ""; // ページに表示するメッセージ
$page_error = ""; // エラーメッセージ

// エラーチェック
if (isset($request["send"])) {
    if ($request["email"] == "") {
        $page_error = "メールアドレスを入力してください\n";
    }
    if ($page_error == "") {
        if (!preg_match('/^([a-zA-Z0-9\.\_\-\+\?\#\&\%])*@([a-zA-Z0-9\_\-])+([a-zA-Z0-9\.\_\-]+)+$/', $request["email"])) {
            $page_error = "メールアドレスを正しく入力してください\n";
        }
    }
}

// 送信実行
if (isset($request["send"]) && $page_error == "") {
    // 初期設定
    mb_language("japanese"); // メール送信の際のおまじない
    mb_internal_encoding("UTF-8"); // メール送信の際のおまじない
    
    // 送信本文の作成
    $mail_body = "";
    if (isset($request["uname"])) {
        $mail_body .= "[お名前]\n";
        $mail_body .= "{$request["uname"]}\n";
    }
    if (isset($request["email"])) {
        $mail_body .= "[メールアドレス]\n";
        $mail_body .= "{$request["email"]}\n";
    }
    if (isset($request["body"])) {
        $mail_body .= "[お問い合わせ内容]\n";
        $mail_body .= "{$request["body"]}\n";
    }
    
    // 送信実行
    $subject = "お問い合わせがありました";
    $admin_email = "you@example.com"; // あなたのメールアドレスを入力してください
    $add_header = "From:" . $admin_email;
    $result = mb_send_mail($admin_email, $subject, $mail_body, $add_header);
    
    // 完了
    $page_message = $request["uname"] . "さん、送信ありがとうございました！";
}
?>

<?php $page_title = "お問い合わせ";?>
<?php require "header.php";?>
    <p>
      <?php echo he($page_message); ?>
    </p>
    <p class="attention">
      <?php echo he($page_error); ?>
    </p>
    <p>
      お問い合わせは以下よりお願いします
    </p>
    <form action="inquiry.php" method="post">
      <div>
        お名前<br>
        <input type="text" name="uname" size="30" value="<?php echo he($request["uname"]); ?>">
      </div>
      <div>
        メールアドレス <span class="attention">[必須]</span><br>
        <input type="text" name="email" size="30" value="<?php echo he($request["email"]); ?>">
      </div>
      <div>
        お問い合わせ内容<br>
        <textarea name="body" rows="5" cols="20"><?php echo he($request["body"]); ?></textarea>
      </div>
      <div>
        <input type="submit" name="send" value="送信する">
      </div>
    </form>
<?php require "footer.php";?>
