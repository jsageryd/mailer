PHP mailer
==========

This is a simple PHP script to allow easy creation of arbitrary mail forms.

The variables defined at the top of `scripts/mailer.php` may be overridden to create a custom form.
The field `$formpage_name` must always be overridden to contain the name/URI of the form page.
See `example.php` and `example2.php` for usage examples.

Example of sent e-mail (screenshot2.png):

	From - Wed Nov 11 20:08:50 2009
	X-Mozilla-Status: 0001
	X-Mozilla-Status2: 00000000
	Return-Path: <##########>
	X-Original-To: ##########
	Delivered-To: ##########
	Received: by ########## (Postfix, from userid ##)
		id ##########; Wed, 11 Nov 2009 20:08:50 +0900 (JST)
	To: Taro Yamada <##########>
	Subject: =?UTF-8?B?44GK5ZWP44GE5ZCI44KP44Gb?=
	From: 田中純一郎 (10.0.1.1) <jun@tanaka.com>
	Reply-To: 田中純一郎 <jun@tanaka.com>
	MIME-Version: 1.0
	Content-Type: text/plain; charset=UTF-8
	Message-Id: <##########>
	Date: Wed, 11 Nov 2009 20:08:50 +0900 (JST)

	お問い合わせ
	-----------------------------------------

	お名前: 田中純一郎

	メールアドレス: jun@tanaka.com

	確認のためもう一度: jun@tanaka.com

	お電話番号: 080-1234-5678

	ご住所: 東京都新宿区

	メッセージ:
	ハロー

	-----------------------------------------
