<?php
global $form_name, $form_header, $form_rcpt, $form_thankyou, $form_error, $form_invalid, $fields, $submit_text, $formpage_name;

# Default values
$form_name	=	"Contact";
$form_header	=	"<p>Please use this form to send me an e-mail.</p>";
$form_rcpt	=	"Me <me@mydomain.com>";
$form_thankyou	=	"<p>Thank you! I will get back to you.</p>";
$form_error	=	"<p>An error occured while trying to send the e-mail. Sorry for the inconvenience.</p>";
$form_invalid	=	"<p>Please correct the fields marked in red and try again.</p>";
$submit_text	=	"Send e-mail";
$formpage_name	=	"mailer.php";
$fields = array(
			array(	field_name	=> 'name',
				field_desc	=> 'Your name',
				can_be_empty	=> false,
				same_value_as	=> '',
				field_type	=> 'input',
				field_group	=> ''),

			array(	field_name	=> 'mail',
				field_desc	=> 'Your e-mail address',
				can_be_empty	=> false,
				same_value_as	=> 'mail_confirm',
				field_type	=> 'input',
				field_group	=> ''),

			array(	field_name	=> 'mail_confirm',
				field_desc	=> 'Your e-mail address, again',
				can_be_empty	=> false,
				same_value_as	=> 'mail',
				field_type	=> 'input',
				field_group	=> ''),

			array(	field_name	=> 'message',
				field_desc	=> 'Your message',
				can_be_empty	=> false,
				same_value_as	=> '',
				field_type	=> 'area',
				field_group	=> ''),
		);

function field_value($field_name){
	return $_POST[$field_name];
}

function form_is_valid(){
	global $fields;
	if(empty($fields)) return false;
	foreach($fields as $field){
		if(!field_is_valid($field)) return false;
	}
	return true;
}

function field_is_valid($field){
	return	($field['can_be_empty'] || (strcmp(field_value($field['field_name']),'') != 0)) &&
		((strcmp($field['same_value_as'],'') == 0) || (strcmp(field_value($field['field_name']), field_value($field['same_value_as'])) == 0));
}

function make_body(){
	global $form_name;
	global $fields;
	$b =	$form_name . "\n";
	$b .=	"-----------------------------------------\n\n";
	foreach($fields as $field){
		if($field['field_type'] == 'input'){
			$b .=	$field['field_desc'] . ': ' . field_value($field['field_name']) . "\n\n";
		}else{
			$b .=	$field['field_desc'] . ":\n" . field_value($field['field_name']) . "\n\n";
		}
	}
	$b .=	"-----------------------------------------";
	return $b;
}

function print_mailer(){
	global $form_name, $form_header, $form_rcpt, $form_thankyou, $form_error, $form_invalid;
	if(form_is_posted() && form_is_valid()){
		$name=$_POST['name'];
		$mail=$_POST['mail'];
		$subj="=?UTF-8?B?".base64_encode($form_name)."?=\n";
		$body=make_body();
		$head="From: $name ($_SERVER[REMOTE_ADDR]) <$mail>\n";
		$head.="Reply-To: $name <$mail>\n";
		$head.="MIME-Version: 1.0\n";
		$head.="Content-Type: text/plain; charset=UTF-8";
		if(mail($form_rcpt, $subj, $body, $head)){
			echo $form_thankyou;
		}else{
			echo $form_error;
			print_form();
		};
	}else{
		if(form_is_posted()){
			print_form($form_invalid);
		}else{
			print_form($form_header);
		}
	};
}

function print_form($header){
	global $submit_text, $formpage_name, $fields;
	echo $header . "\n";
	echo "<form action=\"" . $formpage_name . "\" method=\"post\" accept-charset=\"utf-8\">\n";
	echo "	<input type=\"hidden\" id=\"posted\" name=\"posted\" value=\"yes\" />\n";
	$lastgroup = '';
	foreach($fields as $field){
		$grp = $field['field_group'];
		if(strcasecmp($grp,$lastgroup) != 0){
			if(!empty($lastgroup)){
				echo "</div>\n";
			}
			if(!empty($grp)){
				echo "<div class=\"group\">\n";
			}
		}
		if(strcasecmp($field['field_type'],'input') == 0){
			field_input($field);
		}elseif(strcasecmp($field['field_type'],'area') == 0){
			field_area($field);
		}
		$lastgroup = $grp;
	}
	echo "	<p>\n";
	echo "		<input type=\"submit\" id=\"send\" name=\"send\" value=\"".$submit_text."\" class=\"submit\" />\n";
	echo "	</p>\n";
	echo "</form>\n";
}

function field_input($field){
	$name = $field['field_name'];
	$desc = $field['field_desc'];
	echo "	<p>\n";
	echo "		<label for=\"$name\" class=\"".field_class($field)."\">$desc</label><br />\n";
	echo "		<input type=\"text\" id=\"$name\" name=\"$name\" class=\"".field_class($field)."\" value=\"".field_value($name)."\" />\n";
	echo "	</p>\n";
}

function field_area($field){
	$name = $field['field_name'];
	$desc = $field['field_desc'];
	echo "	<p>\n";
	echo "		<label for=\"$name\" class=\"".field_class($field)."\">$desc</label><br />\n";
	echo "		<textarea style=\"overflow: hidden\" id=\"$name\" name=\"$name\" cols=\"30\" rows=\"8\" class=\"".field_class($field)."\">".field_value($name)."</textarea>\n";
	echo "	</p>\n";
}

function form_is_posted(){
	return strcmp(field_value('posted'),'yes')==0;
}

function field_class($field){
	return (!form_is_posted() || field_is_valid($field)) ? 'text' : 'attention';
}
?>
