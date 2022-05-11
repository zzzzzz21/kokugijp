<?php
session_start();
//var_dump($_POST["csrf_token"]);
//var_dump($_SESSION['csrf_token']);
//break;
if (!(isset($_POST["csrf_token"])
    && $_POST["csrf_token"] === $_SESSION['csrf_token'])) {
// header('HTTP/1.1 403 Forbidden');
  header("HTTP/1.1 302");
  header('Location : ./index.php');
  exit;
}
$toke_byte = substr(base_convert(hash('sha256', uniqid()), 16, 36), 0, 16);
$csrf_token = bin2hex($toke_byte);
$_SESSION['csrf_token2'] = $csrf_token;
/*******************************************************/
/* 送信データ定義 */
/* [key(POST[key]), name(for message), rule] */
$rules = array(
    array('name', 'お名前（漢字）', 'required'),
    array('kana', 'お名前（ふりがな）', 'required'),
    array('bday_year', '生年月日（年）', 'required'),
    array('bday_month', '生年月日（月）', 'required'),
    array('bday_day', '生年月日（日）', 'required'),
    array('postal_code1', '郵便番号', 'required'),
    array('postal_code2', '郵便番号', 'required'),
    array('address_level1', 'ご住所', 'required'),
    array('tel1', 'お電話番号', 'required'),
    array('tel2', 'お電話番号', 'required'),
    array('tel3', 'お電話番号', 'required'),
    array('fax1', 'FAX', ''),
    array('fax2', 'FAX', ''),
    array('fax3', 'FAX', ''),
    array('email', 'メールアドレス', 'required|email'),
    array('email2', 'メールアドレス（確認）', 'required|email'),
    array('other_content', 'ご質問など', ''),
    array('agree', 'プライバシーポリシー', ''),
);
/*******************************************************/
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  header('HTTP/1.1 403 Forbidden');
  exit;
}
$form = $_POST;
$_SESSION['post'] = $_POST;
$post = $_SESSION['post'];
unset($_SESSION['res']);
$result = validation($form, $rules);
$_SESSION['res'] = $result;
if ($result['isSuccess'] !== true) {
  header("HTTP/1.1 302");
  header('Location : ./index.php');
}
/* end. */
function validation($form, $rules) {
  $result = array('isSuccess' => true);
  $err = array();
  foreach ($rules as $rule) {
    list($key, $name, $lists) = $rule;
    $lists = explode('|', $lists);
    foreach ($lists as $list) {
      switch ($list) {
        case 'required':
          if ($form[$key] == '') {
            $result['isSuccess'] = false;
            $err[$key][] = "※「" . $name . "」は必須です。";
            break;
          }
          break;
        case 'email':
          if ($form[$key] !== '') {
            if (mb_strlen($form[$key], 'UTF-8') > 255 || preg_match('/\A.+@.+\z/', $form[$key]) !== 1) {
              $result['isSuccess'] = false;
              $err[$key][] = "有効なメールアドレスではありません。";
            }
          }
          break;
        case 'tel':
          if ($form[$key] !== '') {
            $tmp = mb_convert_kana(str_replace('-', '', $form[$key]), 'n');
            if (preg_match('/\A[0-9]{10,11}\z/', $tmp) !== 1) {
              $result['isSuccess'] = false;
              $err[$key][] = "電話番号は10桁、または11桁の数値で入力してください。";
            }
          }
          break;
        default:
          break;
      }
    }
  }
  $result['err'] = $err;
  return $result;
}

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
    <form class="p-contact-content h-adr" method="post" action="mail.php">
      <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
      <div class="p-contact-input">
        <div class="c-input">
          <div class="c-input-block">
            <label for="form-name" class="c-input-head">
              <span class="c-input-label">必須</span>
              <span class="c-input-name">お名前（漢字）</span>
            </label>
            <div class="c-input-content">
              <input class="c-input-text" id="form-name" type="text" name="name" value="<?php if (isset($post['name'])) echo htmlspecialchars($post['name']); ?>" readonly="readonly">
            </div>
          </div>
          <div class="c-input-block">
            <label for="form-kana" class="c-input-head">
              <span class="c-input-label">必須</span>
              <span class="c-input-name">お名前（ふりがな）</span>
            </label>
            <div class="c-input-content">
              <input class="c-input-text" id="form-kana" type="text" name="kana" value="<?php if (isset($post['kana'])) echo htmlspecialchars($post['kana']); ?>" readonly="readonly">
            </div>
          </div>
          <div class="c-input-block">
            <label for="form-year" class="c-input-head">
              <span class="c-input-label">必須</span>
              <span class="c-input-name">生年月日</span>
            </label>
            <div class="c-input-content is-nowrap">
              <cpan class="c-input-content-confirm">
                <?php if (isset($post['bday_year'])) echo htmlspecialchars($post['bday_year']); ?>年<?php if (isset($post['bday_month'])) echo htmlspecialchars($post['bday_month']); ?>月<?php if (isset($post['bday_day'])) echo htmlspecialchars($post['bday_day']); ?>日</cpan>
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
                    <cpan class="c-input-content-confirm">
                      <?php if (isset($post['postal_code1'])) echo htmlspecialchars($post['postal_code1']); ?> - <?php if (isset($post['postal_code2'])) echo htmlspecialchars($post['postal_code2']); ?>
                    </cpan>
                  </span>
              </div>
              <div class="c-input-address">
                <input class="c-input-text p-region p-locality p-street-address p-extended-address" type="text" name="address_level1" value="<?php if (isset($post['address_level1'])) echo htmlspecialchars($post['address_level1']); ?>" readonly="readonly">
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
                <cpan class="c-input-content-confirm">
                  <?php if (isset($post['tel1'])) echo htmlspecialchars($post['tel1']); ?>－<?php if (isset($post['tel2'])) echo htmlspecialchars($post['tel2']); ?>－<?php if (isset($post['tel3'])) echo htmlspecialchars($post['tel3']); ?>
                </cpan>
              </div>
            </div>
          </div>
          <div class="c-input-block">
            <label for="form-fax1" class="c-input-head">
              <span class="c-input-name">FAX</span>
            </label>
            <div class="c-input-content">
              <div class="c-input-phone">
                <cpan class="c-input-content-confirm">
                  <?php if (isset($post['fax1'])) echo htmlspecialchars($post['fax1']); ?>－<?php if (isset($post['fax2'])) echo htmlspecialchars($post['fax2']); ?>－<?php if (isset($post['fax3'])) echo htmlspecialchars($post['fax3']); ?>
                </cpan>
              </div>
            </div>
          </div>
          <div class="c-input-block">
            <label for="form-email1" class="c-input-head">
              <span class="c-input-label">必須</span>
              <span class="c-input-name">メールアドレス</span>
            </label>
            <div class="c-input-content">
              <input class="c-input-text" id="form-email1" type="email" name="email" readonly="readonly" value="<?php if (isset($post['email'])) echo htmlspecialchars($post['email']); ?>">
            </div>
          </div>
          <div class="c-input-block">
            <label for="form-email2" class="c-input-head">
              <span class="c-input-label">必須</span>
              <span class="c-input-name">メールアドレス（確認）</span>
            </label>
            <div class="c-input-content">
              <input class="c-input-text" id="form-email2" type="email" name="email2" readonly="readonly" value="<?php if (isset($post['email2'])) echo htmlspecialchars($post['email2']); ?>">
            </div>
          </div>
          <div class="c-input-block">
            <label for="form-other" class="c-input-head">
              <span class="c-input-name">ご質問など</span>
            </label>
            <div class="c-input-content">
              <cpan class="c-input-content-confirm">
                <?php if (isset($post['other_content'])) echo nl2br(htmlspecialchars($post['other_content'])); ?>
              </cpan>
            </div>
          </div>
        </div>
      </div>
      <div class="p-contact-check">
        <button type="button" onClick="javascript:history.back(-1)" class="p-contact-check-button c-secondary-button is-border">修　正</button>
        <button type="submit" class="p-contact-check-button c-secondary-button">送　信</button>
      </div>
    </form>
  </div>
</section>

<div id="footer">
  <address>Copyright ©️ KokudoGiken Corporation All Rights Reserved.</address>
</div>
</body>
</html>