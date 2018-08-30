<?php
/**
 * JobRoller Registration Form
 * Function outputs the registration form
 *
 *
 * @version 1.0
 * @author AppThemes
 * @package JobRoller
 * @copyright 2010 all rights reserved
 *
 */

function mfthemes_register_form( $action = '', $role = 'job_lister' ) {
	
    global $posted;

    if ( get_option('users_can_register') ) :

        if (!$action) $action = site_url('wp-login.php?action=register');
    ?>

            <form action="<?php echo $action; ?>" method="post" class="account_form">
				
				<div class="item">
					<label for="your_username"><?php _e('Username&#58;', 'LoveVideo'); ?></label>
					<input type="text" class="text" name="your_username" id="your_username" tabindex="1" value="<?php if (isset($posted['your_username'])) echo $posted['your_username']; ?>" /><span><?php _e('Login user name, only accept letters and numbers', 'LoveVideo'); ?></span>
				</div>
				<div class="item">
					<label for="your_email"><?php _e('Email&#58;', 'LoveVideo'); ?></label>
					<input type="email" class="text" name="your_email" id="your_email" tabindex="2" value="<?php if (isset($posted['your_email'])) echo $posted['your_email']; ?>" />
				</div>
				<div class="item">
					<label for="your_password"><?php _e('Password&#58;', 'LoveVideo'); ?></label>
					<input type="password" class="text" name="your_password" id="your_password" tabindex="3" value="" /><span><?php _e('Password length is greater than 8', 'LoveVideo'); ?></span>
				</div>
				<div class="item">
					<label for="your_password_2"></label>
					<input type="password" class="text" name="your_password_2" id="your_password_2" tabindex="4" value="" /><span><?php _e('Repeat the password', 'LoveVideo'); ?></span>
				</div>
				<div class="item">
					<div class="captcha clx">
					<label><?php _e('Captcha&#58;', 'LoveVideo'); ?></label>
					
					<img id="captcha_img" src="<?php echo get_template_directory_uri();?>/functions/forms/register/captcha/captcha.php" title="<?php _e('See? Click replace', 'LoveVideo'); ?>" alt="<?php _e('See? Click replace', 'LoveVideo'); ?>" onclick="document.getElementById('captcha_img').src='<?php echo get_template_directory_uri();?>/functions/forms/register/captcha/captcha.php?'+Math.random();document.getElementById('CAPTCHA').focus();return false;" />
					<a href="javascript:void(0)" onclick="document.getElementById('captcha_img').src='<?php echo get_template_directory_uri();?>/functions/forms/register/captcha/captcha.php?'+Math.random();document.getElementById('captcha').focus();return false;"><span><?php _e('Click replace', 'LoveVideo'); ?></span></a>
					</div><label for="captcha"></label><input id="captcha" class="text" type="text" tabindex="5" value="" name="captcha_code" />
				</div>
				<div class="item">
					<input type="submit" class="submit submit-button" tabindex="6" name="register" value="<?php _e('Create Account', 'LoveVideo'); ?>" />
				</div>

            </form>
<?php endif; ?>

<?php } ?>