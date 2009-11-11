<?php include('scripts/mailer.php'); ?>
<?php
global $form_name, $form_header, $form_rcpt, $form_thankyou, $form_error, $form_invalid, $fields, $submit_text, $formpage_name;

# Override values
$form_rcpt	=	"Taro Yamada <yamada@mydomain.com>";
$formpage_name	=	"example.php";
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
