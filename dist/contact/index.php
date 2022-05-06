<?php
session_start();
$toke_byte = substr(base_convert(hash('sha256', uniqid()), 16, 36), 0, 16);
$csrf_token = bin2hex($toke_byte);
$_SESSION['csrf_token'] = $csrf_token;
$res = (isset($_SESSION['res']) ? $_SESSION['res'] : '');
$post = (isset($_SESSION['post']) ? $_SESSION['post'] : '');
?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>採用お問い合わせ - 国土技建株式会社</title>

  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="content-language" content="ja">
  <meta name="keywords" content="国土技建株式会社,国土技建　広島,公共工事全般,道路関連工事,交通安全施設工事">
  <meta name="description" content="人に優しい地域づくりの実現を目指して――私たちは高品質の安心・安全を創るプロフェッショナルです">

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="../css/reset.css" media="all">
  <link rel="stylesheet" type="text/css" href="../css/common.css" media="all">
  <link rel="stylesheet" type="text/css" href="../css/privacy.css" media="all">
  <!-- ink rel="stylesheet" type="text/css" href="../css/sp.css" media="all" media="all and (max-width:480px)" -->
  <link rel="stylesheet" type="text/css" href="../css/print.css" media="print" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

</head>
<body class="drawer">
<section class="l-full">
  <h1 class="l-full-title"><a href="../index.html"><img src="../img/logo2.png" width="247" height="40" alt="国土技建株式会社"></a></h1>
  <div class="p-contact">
    <h2 class="p-contact-title">採用お問い合わせ</h2>
    <p class="p-contact-lead">下記項目へ必要事項をご記入の上、送信ボタンをクリックしてください。</p>
    <script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
    <form class="p-contact-content h-adr" method="post" action="confirm.php">
      <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
      <span class="p-country-name" style="display:none;">Japan</span>
      <div class="p-contact-input">
        <div class="c-input">
          <div class="c-input-block">
            <label for="form-name" class="c-input-head">
              <span class="c-input-label">必須</span>
              <span class="c-input-name">お名前（漢字）</span>
            </label>
            <div class="c-input-content">
              <input class="c-input-text" id="form-name" type="text" name="name" autocomplete="name"  required>
            </div>
          </div>
          <div class="c-input-block">
            <label for="form-kana" class="c-input-head">
              <span class="c-input-label">必須</span>
              <span class="c-input-name">お名前（ふりがな）</span>
            </label>
            <div class="c-input-content">
              <input class="c-input-text" id="form-kana" type="text" name="kana" required>
            </div>
          </div>
          <div class="c-input-block">
            <label for="form-year" class="c-input-head">
              <span class="c-input-label">必須</span>
              <span class="c-input-name">生年月日</span>
            </label>
            <div class="c-input-content is-nowrap">
              <div class="c-input-birthday">
                <input class="c-input-text is-number is-year" id="form-year" type="text" name="bday_year" autocomplete="bday_year" placeholder="1970" size="4" maxlength="4" required>
                <span class="c-input-birthday-divide">年</span>
              </div>
              <div class="c-input-birthday">
                <input class="c-input-text is-day" id="form-month" type="text" name="bday_month" autocomplete="bday_month" placeholder="1" maxlength="2" required>
                <span class="c-input-birthday-divide">月</span>
              </div>
              <div class="c-input-birthday">
                <input class="c-input-text is-day" id="form-day" type="text" name="bday_day" autocomplete="bday_day" placeholder="1" maxlength="2" required>
                <span class="c-input-birthday-divide">日</span>
              </div>
            </div>
          </div>
          <div class="c-input-block">
            <div class="c-input-head">
              <span class="c-input-label">必須</span>
              <span class="c-input-name">住所</span>
            </div>
            <div class="c-input-content">
              <div class="c-input-post">
                <span class="c-input-post-mark">〒</span>
                <span class="c-input-post-number">
                    <input type="text" class="c-input-text is-postal-code p-postal-code" name="postal_code1" placeholder="000" size="3" maxlength="3" required>
                    <span class="c-input-block-bar">－</span>
                  </span>
                <span class="c-input-post-number">
                    <input type="text" class="c-input-text is-postal-code p-postal-code" name="postal_code2" placeholder="0000" size="4" maxlength="4" required>
                  </span>
              </div>
              <div class="c-input-address">
                <input class="c-input-text p-region p-locality p-street-address p-extended-address" type="text" name="address_level1" autocomplete="address-level1" required>
              </div>
            </div>
          </div>
          <div class="c-input-block">
            <label for="form-tel1" class="c-input-head">
              <span class="c-input-label">必須</span>
              <span class="c-input-name">TEL</span>
            </label>
            <div class="c-input-content">
              <div class="c-input-phone">
                <input class="c-input-text is-number is-tel1" id="form-tel1" type="text" name="tel1"  maxlength="4" required>
                <span class="c-input-block-bar">－</span>
                <input class="c-input-text is-number is-tel2" id="form-tel2" type="text" name="tel2"  maxlength="4" required>
                <span class="c-input-block-bar">－</span>
                <input class="c-input-text is-number is-tel3" id="form-tel3" type="text" name="tel3"  maxlength="4" required>
              </div>
            </div>
          </div>
          <div class="c-input-block">
            <label for="form-fax1" class="c-input-head">
              <span class="c-input-name">FAX</span>
            </label>
            <div class="c-input-content">
              <div class="c-input-phone">
                <input class="c-input-text is-number is-tel1" id="form-fax1" type="text" name="fax1" maxlength="4">
                <span class="c-input-block-bar">－</span>
                <input class="c-input-text is-number is-tel2" id="form-fax2" type="text" name="fax2" maxlength="4">
                <span class="c-input-block-bar">－</span>
                <input class="c-input-text is-number is-tel3" id="form-fax3" type="text" name="fax3" maxlength="4">
              </div>
            </div>
          </div>
          <div class="c-input-block">
            <label for="form-email1" class="c-input-head">
              <span class="c-input-label">必須</span>
              <span class="c-input-name">メールアドレス</span>
            </label>
            <div class="c-input-content">
              <input class="c-input-text" id="form-email1" type="email" name="email" autocomplete="email" required>
            </div>
          </div>
          <div class="c-input-block">
            <label for="form-email2" class="c-input-head">
              <span class="c-input-label">必須</span>
              <span class="c-input-name">メールアドレス（確認）</span>
            </label>
            <div class="c-input-content">
              <input class="c-input-text" id="form-email2" type="email" name="email2" autocomplete="email2" required oninput="CheckEmail(this)">
            </div>
          </div>
          <div class="c-input-block">
            <label for="form-other" class="c-input-head">
              <span class="c-input-name">ご質問など</span>
            </label>
            <div class="c-input-content">
              <textarea class="c-input-area" id="form-other" name="other_content" aria-multiline="true"></textarea>
            </div>
          </div>
        </div>
      </div>
      <p class="p-contact-message"> 当社<a href="../privacy.html" class="c-common-link" target="_blank">プライバシーポリシー</a>に同意頂ける場合は<br>「同意する」にチェックを付け「送信」ボタンをクリックしてください。 </p>
      <div class="p-contact-check">
        <label for="form-agree" class="p-contact-check-label">同意する</label>
        <input type="checkbox" name="agree" id="form-agree" class="p-contact-check-input c-input-check">
        <button type="submit" class="p-contact-check-button c-secondary-button">送　信</button>
      </div>
    </form>
  </div>
</section>
<div id="footer">
  <address>Copyright ©️ KokudoGiken Corporation All Rights Reserved.</address>
</div>
<script>
  function CheckEmail(input){
    let mail = document.getElementById("form-email1").value; //メールフォームの値を取得
    let mailConfirm = input.value; //メール確認用フォームの値を取得(引数input)

    // mメールアドレス一致確認
    if(mail !== mailConfirm){
      input.setCustomValidity('メールアドレスが一致しません'); // エラーメッセージのセット
    }else{
      input.setCustomValidity(''); // エラーメッセージのクリア
    }
  }
</script>
</body>
</html>