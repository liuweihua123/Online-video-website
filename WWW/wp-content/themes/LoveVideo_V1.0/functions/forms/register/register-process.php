<?php
/**
 * LoveVideo Register Process
 * Processes the registration forms and returns errors/redirects to a page
 *
 *
 * @version 1.0
 * @author LoveVideo
 * @copyright 2010 all rights reserved
 *
 */

function mfthemes_process_register_form( $success_redirect = '' ) {

        // if there's no redirect posted, send them to their job dashboard
	if (!$success_redirect)
            $success_redirect = get_bloginfo('url');

	
	if ( get_option('users_can_register') ) :
		
		global $posted, $app_abbr;
		
		$posted = array();
		$errors = new WP_Error();
		$user_pass = wp_generate_password();
		
		if (isset($_POST['register']) && $_POST['register']) {

                        // include the WP registration core
			require_once( ABSPATH . WPINC . '/registration.php');

		
			// Get (and clean) data
			$fields = array(
				'your_username',
				'your_email',
				'your_password',
				'your_password_2',
				'role'
			);
			foreach ($fields as $field) {
				if (isset($_POST[$field])) $posted[$field] = stripslashes(trim($_POST[$field])); else $posted[$field] = '';
			}
		
			$user_login = sanitize_user( $posted['your_username'] );
			$user_email = apply_filters( 'user_registration_email', $posted['your_email'] );
			$user_role = get_option('default_role');

			
			// Check the username
			if ( $posted['your_username'] == '' )
				$errors->add('empty_username', __('<strong>ERROR</strong>: Please enter a username.', 'LoveVideo'));
			elseif ( !validate_username( $posted['your_username'] ) ) {
				$errors->add('invalid_username', __('<strong>ERROR</strong>: This username is invalid.  Please enter a valid username.', 'LoveVideo'));
				$posted['your_username'] = '';
			} elseif ( username_exists( $posted['your_username'] ) )
				$errors->add('username_exists', __('<strong>ERROR</strong>: This username is already registered, please choose another one.', 'LoveVideo'));
		
			// Check the e-mail address
			if ($posted['your_email'] == '') {
				$errors->add('empty_email', __('<strong>ERROR</strong>: Please type your e-mail address.', 'LoveVideo'));
			} elseif ( !is_email( $posted['your_email'] ) ) {
				$errors->add('invalid_email', __('<strong>ERROR</strong>: The email address isn&#8217;t correct.', 'LoveVideo'));
				$posted['your_email'] = '';
			} elseif ( email_exists( $posted['your_email'] ) )
				$errors->add('email_exists', __('<strong>ERROR</strong>: This email is already registered, please choose another one.', 'LoveVideo'));
			

				// Check Passwords match
				if ($posted['your_password'] == '')	
					$errors->add('empty_password', __('<strong>ERROR</strong>: Please enter a password.', 'LoveVideo'));
				elseif ( strlen($posted['your_password']) < 8 )	
					$errors->add('empty_password', __('<strong>ERROR</strong>: Password length least 8 words', 'LoveVideo'));
				elseif ($posted['your_password_2'] == '')
					$errors->add('empty_password', __('<strong>ERROR</strong>: Please enter password twice.', 'LoveVideo'));
				elseif ($posted['your_password'] !== $posted['your_password_2'])
					$errors->add('wrong_password', __('<strong>ERROR</strong>: Passwords do not match.', 'LoveVideo'));
				
				$user_pass = $posted['your_password'];
			
            if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captcha_code'])) != $_SESSION['captcha']) {
				$errors->add('captcha_spam',  __('<strong>ERROR</strong>: Wrong captcha.', 'LoveVideo'));
			}
			unset($_SESSION['captcha']);
	
			
			do_action('register_post', $posted['your_username'], $posted['your_email'], $errors);
			$errors = apply_filters( 'registration_errors', $errors, $posted['your_username'], $posted['your_email'] );
		
                        // if there are no errors, let's create the user account
			if ( !$errors->get_error_code() ) {

                           
                            $user_id = wp_create_user(  $posted['your_username'], $user_pass, $posted['your_email'] );
                            if ( !$user_id ) {
                                    $errors->add('registerfail', sprintf(__('<strong>ERROR</strong>: Couldn&#8217;t register you... please contact the <a href="mailto:%s">webmaster</a> !', 'LoveVideo'), get_option('admin_email')));
                                    return array( 'errors' => $errors, 'posted' => $posted);
                            }

                            // Change role
                            wp_update_user( array ('ID' => $user_id, 'role' => $user_role) ) ;
							
								// set the WP login cookie
								$secure_cookie = is_ssl() ? true : false;
								wp_set_auth_cookie($user_id, true, $secure_cookie);
								
								// mail to new user 
								mfthemes_newuesr_notify($posted['your_username'], $posted['your_password'], $posted['your_email']);
								
								// redirect
								$success_redirect = get_author_posts_url($user_id);
								wp_redirect($success_redirect);
								exit;

			} else {

                            // there were errors so go back and display them without creating new user
                            return array( 'errors' => $errors, 'posted' => $posted);

			}
		}
		
	endif;

}