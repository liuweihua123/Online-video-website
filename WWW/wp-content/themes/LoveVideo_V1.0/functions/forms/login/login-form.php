<?php

function mfthemes_login_form( $action = '', $redirect = '' ) {

	global $posted;
	
	if (!$action) $action = site_url('wp-login.php');
	if (!$redirect) $redirect =  get_admin_url();
	?>
	<form action="<?php echo $action; ?>" method="post" class="account_form">
				<div class="item">
					<label class="wx" for="login_username"><?php _e('Username&#58;', 'LoveVideo'); ?></label>
					<input type="text" class="text" name="log" id="login_username" tabindex="1" value="<?php if (isset($_POST['log'])) echo $_POST['log']; ?>" />
				</div>
				<div class="item">
					<label class="wx" for="login_password"><?php _e('Password&#58;', 'LoveVideo'); ?></label>
					<input type="password" class="text" name="pwd" id="login_password" tabindex="2" value="" />
				</div>
				
				<?php if( $_SESSION["trytimes"] > 3) {?>
					<div class="item">
						<div class="captcha clx">
						<label><?php _e('Captcha&#58;', 'LoveVideo'); ?></label>
						
						<img id="captcha_img" src="<?php echo get_template_directory_uri();?>/functions/forms/register/captcha/captcha.php" title="<?php _e('See? Click replace', 'LoveVideo'); ?>" alt="<?php _e('See? Click replace', 'LoveVideo'); ?>" onclick="document.getElementById('captcha_img').src='<?php echo get_template_directory_uri();?>/functions/forms/register/captcha/captcha.php?'+Math.random();document.getElementById('CAPTCHA').focus();return false;" />
						<a href="javascript:void(0)" onclick="document.getElementById('captcha_img').src='<?php echo get_template_directory_uri();?>/functions/forms/register/captcha/captcha.php?'+Math.random();document.getElementById('captcha').focus();return false;"><span><?php _e('Click replace', 'LoveVideo'); ?></span></a>
						</div><label for="captcha"></label><input id="captcha" class="text" type="text" tabindex="5" value="" name="captcha_code" />
					</div>
				<?php }?>
				<div class="item">
					<label>&nbsp;</label>
					<p class="remember">
						<input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="3">
						<label for="rememberme" class="remember"><?php _e('Auto login', 'LoveVideo'); ?></label>
						| <a href="<?php echo site_url('wp-login.php?action=lostpassword', 'login') ?>"><?php _e('Lost your password?', 'LoveVideo'); ?></a>
					</p>
				</div>
				<div class="item">
					<input type="submit" class="submit submit-button" name="login" value="<?php _e('Login', 'LoveVideo'); ?>" />
				</div>
				<input type="hidden" name="redirect_to" value="<?php echo $redirect; ?>" />
	</form>

<?php
}
?>