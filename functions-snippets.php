<?php
$message_title = 'Passwort zurücksetzen für die Webseite abc.com';
$message_template = 'Hallo,

jemand hat die Änderung Ihres Passworts beantragt. Um diese Änderung zu bestätigen, klicken Sie bitte auf den folgenden Link:

${password_reset_link}

Sollten Sie die Änderung nicht veranlasst haben, so ignorieren Sie einfach diese E-Mail. Ihr bisheriges Passwort wird sich dann nicht ändern.

Viele Grüße

Ihr Webmaster'

// Change the title of the password reset e-mail
function nxt_password_reset_title($title) {
	return $message_title;
}
add_filter('retrieve_password_title', 'nxt_password_reset_title');

// Change the body text of the password reset e-mail
function nxt_retrieve_password_message( $message, $key, $user_login) {
	$password_reset_link = network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' );
	return str_replace($message_template, "${password_reset_link}", $password_reset_link);;
}
add_filter( 'retrieve_password_message', 'nxt_retrieve_password_message', 10, 4 );
