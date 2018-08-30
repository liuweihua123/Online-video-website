<?php
/**
 * LoveVideo Login Part
 * Hooks into various actions in the theme.
 *
 *
 * @version 1.0
 * @author 东少
 * @package LoveVideo
 * @copyright 2014 all rights reserved
 *
 */

global $pagenow;

// what you want login or not
$theaction = isset($_GET['action']) ? $_GET['action'] : '';

// if the user is on the login page, then let the games begin
if ($pagenow == 'wp-login.php' && $theaction != 'logout' && !isset($_GET['key'])) add_action('init', 'mfthemes_login_init', 98);

// main function that routes the request
function mfthemes_login_init() {

	nocache_headers();
	if ( is_user_logged_in() ){
		global $current_user;
		wp_redirect( get_author_posts_url($current_user->ID) );
	}
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'login';

	if( $action == "register" || $action == "login"){session_start();}
    switch($action) :
        case 'lostpassword' :
        case 'retrievepassword' :
            mfthemes_password();
        break;
        case 'register':
			mfthemes_register();
		break;
        case 'login':
        default:
            mfthemes_login();
        break;
    endswitch;
    exit;
}

// Show login forms
function mfthemes_login() {

	global $posted;
	
	$errors = mfthemes_process_login_form();

	// Login times plus 1	
	//$_SESSION["trytimes"] = 0;
	
	// Clear errors if loggedout is set.
	if ( !empty($_GET['loggedout']) ) $errors = new WP_Error();
            
	if ( isset($_POST['testcookie']) && empty($_COOKIE[TEST_COOKIE]) )
			$errors->add('test_cookie', __('Cookies are blocked or not supported by your browser. You must enable cookies to continue.','LoveVideo'));
	
	if ( isset($_GET['loggedout']) && TRUE == $_GET['loggedout'] )
			$message = __('You are now logged out.','LoveVideo');

	elseif	( isset($_GET['registration']) && 'disabled' == $_GET['registration'] )	
			$errors->add('registerdisabled', __('User registration is currently not allowed.','LoveVideo'));

	elseif	( isset($_GET['checkemail']) && 'confirm' == $_GET['checkemail'] )	
			$message = __('Check your email for the confirmation link.','LoveVideo');

	elseif	( isset($_GET['checkemail']) && 'newpass' == $_GET['checkemail'] )	
			$message = __('Check your email for your new password.','LoveVideo');

	elseif	( isset($_GET['checkemail']) && 'registered' == $_GET['checkemail'] )
			$message = __('Registration complete. Please check your e-mail.','LoveVideo');

	get_template_part('header_login');
	?>
	<div id="login" class="clx">
		<h1><?php _e('Login at ','LoveVideo');bloginfo('name'); ?></h1>
		<?php 
			if (isset($message) && !empty($message)) echo '<div id="item-error"><p class="success">'.$message.'</p></div>';
			if (isset($errors) && sizeof($errors)>0 && $errors->get_error_code()) :
				echo '<div id="item-error">';
				foreach ($errors->errors as $error) {
					echo '<p class="error">'.$error[0].'</p>';
				}
				echo '</div>';
			endif;
			mfthemes_login_form(); 
		?>
		<div class="register">
			<?php _e("Don't have a account?","LoveVideo");?><a href="<?php bloginfo('url'); ?>/wp-login.php/?action=register"  title="<?php _e("register here", "LoveVideo");?>"><?php _e("register here", "LoveVideo");?></a>
		</div>
	</div>
	<?php get_template_part('footer_login');
}

// Show register forms
function mfthemes_register() {

	global $posted;
	
	$result = mfthemes_process_register_form();
		
	$errors = $result['errors'];
	$posted = $result['posted'];
	
	// Clear errors if loggedout is set.
	if ( !empty($_GET['loggedout']) ) $errors = new WP_Error();

	// If cookies are disabled we can't log in even with a valid user+pass
	if ( isset($_POST['testcookie']) && empty($_COOKIE[TEST_COOKIE]) )
			$errors->add('test_cookie', __('Cookies are blocked or not supported by your browser. You must enable cookies to continue.','LoveVideo'));
	
	if ( isset($_GET['loggedout']) && TRUE == $_GET['loggedout'] )
			$message = __('You are now logged out.','LoveVideo');

	elseif	( isset($_GET['registration']) && 'disabled' == $_GET['registration'] )	
			$errors->add('registerdisabled', __('User registration is currently not allowed.','LoveVideo'));

	elseif	( isset($_GET['checkemail']) && 'confirm' == $_GET['checkemail'] )	
			$message = __('Check your email for the confirmation link.','LoveVideo');

	elseif	( isset($_GET['checkemail']) && 'newpass' == $_GET['checkemail'] )	
			$message = __('Check your email for your new password.','LoveVideo');

	elseif	( isset($_GET['checkemail']) && 'registered' == $_GET['checkemail'] )
			$message = __('Registration complete. Please check your e-mail.','LoveVideo');

	get_template_part('header_login');
	?>
	<div id="register" class="clx">
		<h1><?php _e('Register at ','LoveVideo');bloginfo('name'); ?></h1>
		本站暂未开放注册，如你有资源需要发布请与我们取得联系！
		<?php 
			if (isset($message) && !empty($message)) echo '<div id="item-error"><p class="success">'.$message.'</p></div>';
			if (isset($errors) && sizeof($errors)>0 && $errors->get_error_code()) :
				echo '<div id="item-error">';
				foreach ($errors->errors as $error) {
					echo '<p class="error">'.$error[0].'</p>';
				}
				echo '</div>';
			endif;
			mfthemes_register_form( '', '' );
		?>
		<div class="login">
			<?php _e("Already to have a account?","LoveVideo");?><a href="<?php bloginfo('url'); ?>/wp-login.php/"  title="<?php _e("Log in directly", "LoveVideo");?>"><?php _e("Log in directly", "LoveVideo");?></a>
		</div>
	</div>
	<?php get_template_part('footer_login');
}

// show the forgot your password page
function mfthemes_password() {
    $errors = new WP_Error();

    if ( isset($_POST['user_login']) && $_POST['user_login'] ) {
        $errors = retrieve_password();

        if ( !is_wp_error($errors) ) {
            wp_redirect('wp-login.php?checkemail=confirm');
            exit();
        }

    }

    if ( isset($_GET['error']) && 'invalidkey' == $_GET['error'] ) $errors->add('invalidkey', __('Sorry, that key does not appear to be valid.','LoveVideo'));

    do_action('lost_password');
    do_action('lostpassword_post');

    get_template_part('header_login');
	?>
	<div id="password" class="clx">
		<h1><?php _e('Password Recovery','LoveVideo');?></h1>
		<?php 
			if (isset($message) && !empty($message)) echo '<div id="item-error"><p class="success">'.$message.'</p></div>';
			if (isset($errors) && sizeof($errors)>0 && $errors->get_error_code()) :
				echo '<div id="item-error">';
				foreach ($errors->errors as $error) {
					echo '<p class="error">'.$error[0].'</p>';
				}
				echo '</div>';
			endif;
			mfthemes_forgot_password_form(); 
		?>
	</div>
	<?php get_template_part('footer_login');
}

?>