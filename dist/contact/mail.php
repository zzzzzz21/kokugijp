<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('HTTP/1.1 403 Forbidden');
    exit;
}
if (!(isset($_POST["csrf_token"])
  && $_POST["csrf_token"] === $_SESSION['csrf_token2'])) {
    // header('HTTP/1.1 403 Forbidden');
    header("HTTP/1.1 302");
    header('Location: ./index.php');
    exit;
}
$form = $_SESSION['post'];

/*******************************************************/
/* 問合せ処理メールアドレス */
define('INQUIRY_EMAIL_ADMIN', 'saiyo@kokugi.jp'); // ADMIN
define('INQUIRY_EMAIL_FROM', 'saiyo@kokugi.jp'); // 送り主
define('INQUIRY_EMAIL_RETURN', 'saiyo@kokugi.jp'); // Return-Path
/*******************************************************/

if ($_SESSION['res']['isSuccess'] === true) {
    send($form); // メールの処理
    $_SESSION = array();
    session_destroy();
    header("HTTP/1.1 302");
    header('Location: ./complete.html');
}
function send($input) {
    // 問い合わせした人
    $headers = 'From: ' . INQUIRY_EMAIL_FROM;
    $params = '-f ' . INQUIRY_EMAIL_RETURN;
    mb_language("Japanese");
    mb_internal_encoding("UTF-8");
    mb_send_mail($input['email'], '【国土技建株式会社】へ採用お問い合わせありがとうございました。', getBody($input), $headers, $params);

    // 管理者宛
    $headers = 'From: ' . INQUIRY_EMAIL_FROM;
    $params = '-f ' . $input['email'];
    mb_language("Japanese");
    mb_internal_encoding("UTF-8");
    mb_send_mail(INQUIRY_EMAIL_ADMIN, '採用お問い合わせを受信しました。｜国土技建株式会社', getBodyAdmin($input), $headers, $params);
}

function getBody($input) {
    return <<< EOM

-------------------------------------------------------------
本メールはお客様からお問い合わせいただいた時点で送信される自動配信メールです。
※本メールに返信はできません。
-------------------------------------------------------------

{$input['name']} 様

国土技建 採用お問い合わせフォームから、
下記の内容でお問い合わせを受け付けました。
内容を確認して担当者から回答しますので、しばらくお待ちください。

---
お名前（漢字）： {$input['name']}
お名前（ふりがな）： {$input['kana']}
生年月日： {$input['bday_year']}年{$input['bday_month']}月{$input['bday_day']}日
住所： {$input['postal_code1']}-{$input['postal_code2']}
　　　 {$input['address_level1']}
TEL： {$input['tel1']}-{$input['tel2']}-{$input['tel3']}
FAX： {$input['fax1']}-{$input['fax2']}-{$input['fax3']}
メールアドレス： {$input['email']}
ご質問など： {$input['other_content']}
---


原則として３営業日以内に、担当者よりご連絡いたします。

よろしくお願いいたします。

================================
国土技建株式会社
https://kokugi.jp/
================================


EOM;
}

function getBodyAdmin($input) {
    return <<< EOM
下記の内容で採用お問い合わせがありました。
内容を確認して、原則として3営業日以内に、回答してください。

---
お名前（漢字）： {$input['name']}
お名前（ふりがな）： {$input['kana']}
生年月日： {$input['bday_year']}年{$input['bday_month']}月{$input['bday_day']}日
住所： {$input['postal_code1']}-{$input['postal_code2']}
　　　 {$input['address_level1']}
TEL： {$input['tel1']}-{$input['tel2']}-{$input['tel3']}
FAX： {$input['fax1']}-{$input['fax2']}-{$input['fax3']}
メールアドレス： {$input['email']}
ご質問など： {$input['other_content']}
---

このメールは 国土技建株式会社のお問い合わせフォームから送信されました。

EOM;
}
