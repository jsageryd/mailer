<?php include('scripts/mailer.php'); ?>
<?php
global $form_name, $form_header, $form_rcpt, $form_thankyou, $form_error, $form_invalid, $fields, $submit_text, $formpage_name;

# Override values
$form_name	=	"お問い合わせ";
$form_header	=	"<p>ご連絡の際は、下記のフォームに必要事項をご記入下さい。</p>";
$form_rcpt	=	"Taro Yamada <yamada@mydomain.com>";
$form_thankyou	=	"<p>お問い合わせ頂きましてありがとうございます。</p><p>できるだけ早くお返事させて頂きますので、今しばらくお待ち下さいませ。</p>";
$form_error	=	"<p>送信エラーです。</p>";
$form_invalid	=	"<p>赤い部分の項目を訂正し、再度送信して下さい。</p>";
$submit_text	=	"送信します";
$formpage_name	=	"example2.php";
$fields = array(
			array(	field_name	=> 'name',
				field_desc	=> 'お名前',
				can_be_empty	=> false,
				same_value_as	=> '',
				field_type	=> 'input',
				field_group	=> ''),

			array(	field_name	=> 'mail',
				field_desc	=> 'メールアドレス',
				can_be_empty	=> false,
				same_value_as	=> 'mail_confirm',
				field_type	=> 'input',
				field_group	=> ''),

			array(	field_name	=> 'mail_confirm',
				field_desc	=> '確認のためもう一度',
				can_be_empty	=> false,
				same_value_as	=> 'mail',
				field_type	=> 'input',
				field_group	=> ''),

			array(	field_name	=> 'phone',
				field_desc	=> 'お電話番号',
				can_be_empty	=> true,
				same_value_as	=> '',
				field_type	=> 'input',
				field_group	=> ''),

			array(	field_name	=> 'address',
				field_desc	=> 'ご住所',
				can_be_empty	=> false,
				same_value_as	=> '',
				field_type	=> 'input',
				field_group	=> ''),

			array(	field_name	=> 'message',
				field_desc	=> 'メッセージ',
				can_be_empty	=> false,
				same_value_as	=> '',
				field_type	=> 'area',
				field_group	=> ''),
		);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Mailer</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<h2><?php echo $form_name ?></h2>
<?php print_mailer(); ?>
</body>
</html>
