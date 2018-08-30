<?php
/**
 * JobRoller Forgot Password Form
 * Function outputs the forgotten password form
 *
 *
 * @version 1.0
 * @author AppThemes
 * @package JobRoller
 * @copyright 2010 all rights reserved
 *
 */

function mfthemes_forgot_password_form() {
	?>
    <p><?php _e('Please enter your username or email address. A new password will be emailed to you.', 'LoveVideo') ?></p>
    <form action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" method="post" class="main_form">
		<div class="item">
			<label for="your_username"><?php _e('Username/Email&#58;', 'LoveVideo'); ?></label>
			<input type="text" class="text" name="user_login" id="login_username" />
		</div>
		<div class="item">
			<label></label>
			<?php do_action('lostpassword_form'); ?><input type="submit" class="submit submit-button" name="login" value="<?php _e('Get New Password','LoveVideo'); ?>" />
		</div>
    </form>
	<?php
}