<?php
/**
 * JobRoller Login Process
 * Processes the login forms and returns errors/redirects to a page
 *
 *
 * @version 1.0
 * @author AppThemes
 * @package JobRoller
 * @copyright 2010 all rights reserved
 *
 */

if (!function_exists('user_can')) :
	function user_can( $user, $capability ) {
		if ( ! is_object( $user ) )
			$user = new WP_User( (int) $user );
		
		if ( ! $user || ! $user->ID )
			return false;
	
		$args = array_slice( func_get_args(), 2 );
		$args = array_merge( array( $capability ), $args );
	
		return call_user_func_array( array( &$user, 'has_cap' ), $args );
	}
endif;

function mfthemes_process_login_form() {

	global $posted;
	
	$errors = new WP_Error();
	ob_start();
	ob_end_clean();
			
	// Login times plus 1	
	$_SESSION["trytimes"] +=1;
	
	if(isset($_POST['captcha_code']) && ( empty($_SESSION['captcha']) || trim(strtolower($_POST['captcha_code']) ) != $_SESSION['captcha'] )) {
		// Wrong captcha
		$errors->add('captcha_spam',  __('<strong>ERROR</strong>: Wrong captcha.', 'LoveVideo'));
	}else{
	
		// If cookies are disabled we can't log in even with a valid user+pass
		if ( is_ssl() && force_ssl_login() && !force_ssl_admin() && ( 0 !== strpos($redirect_to, 'https') ) && ( 0 === strpos($redirect_to, 'http') ) )
			$secure_cookie = false;
		else
			$secure_cookie = '';
	
		$user = wp_signon('', $secure_cookie);

		$redirect_to = get_admin_url();
		
		if ( !is_wp_error($user) ) {
			unset($_SESSION['trytimes']);
			wp_safe_redirect($redirect_to);
			exit;
		}

		$errors = $user;
	}
	unset($_SESSION['captcha']);
	return $errors;

}