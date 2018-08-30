<?php
/**
 * LoveVideo Actions
 * Hooks into actions in the theme.
 *
 *
 * @version 1.0
 * @author 东少
 * @package LoveVideo
 * @copyright 2014 all rights reserved
 *
 */
function mfthemes_header() { ?>
	<div id="header">
		<div id="topbar">
			<div class="topbar-inner">
				<div class="bd clx">
					<div id="logo">
						<?php $options = get_option('mfthemes_options'); $logo =  $options['logo'] ? $options['logo'] : get_bloginfo('template_url')."/assets/images/logo.png" ;?>
						<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo $logo;?>" alt="<?php bloginfo('name'); ?>" /></a>
					</div>
					<?php wp_nav_menu(array( 'theme_location'=>'primary4','container_id' => 'nav')); ?>
					<div id="options">
							<ul>
							<?php if ( is_user_logged_in() ) {
								global $current_user;
								get_currentuserinfo(); 
								$avatar = get_avatar( $current_user->user_email, 80);
							?>
								<li class="more-active">
										<a class="more-top" href="<?php echo get_author_posts_url($current_user->ID);?>"><?php echo get_avatar( $current_user->user_email, 20);echo $current_user->display_name;?></a>
										<div class="more-items">
											
											<?php if( current_user_can( 'manage_options' ) ) {?>
												<div class="more-gap"></div>
												<div class="more-link more-manage"><a href="<?php bloginfo('url'); ?>/wp-admin/"><span><?php _e('Manage Options', 'LoveVideo');?></span></a></div>
											<?php }?>
											<div class="more-gap"></div>
											<div class="more-link more-author"><a href="<?php echo get_author_posts_url($current_user->ID);?>"><?php _e('homepage','LoveVideo');?></a></div>
											<div class="more-link more-profile"><a href="<?php echo get_page_link_by_title('profile');?>"><span><?php _e('Edit my profile', 'LoveVideo');?></span></a></div>
											<div class="more-gap"></div>
											<div class="more-link more-logout"><a href="<?php echo wp_logout_url( get_bloginfo('url') ); ?>" title="<?php _e('logout', 'LoveVideo');?>"><?php _e('logout', 'LoveVideo');?></a></div>
										</div>
								</li>
								<?php }else{?>
									<li class="more-topx more-login"><a href="<?php bloginfo('url'); ?>/wp-login.php" class="loginin" title="<?php _e("login in", "LoveVideo");?>"><?php _e("login in", "LoveVideo");?></a></li>
									<li class="more-topx"><a href="<?php bloginfo('url'); ?>/wp-login.php?action=register" class="signup" title="<?php _e("sign up", "LoveVideo");?>"><?php _e("sign up", "LoveVideo");?></a></li>
								<?php }?>
							</ul>
					</div>
				</div>
			</div>
			<div id="topbar-shadow"></div>
		</div>
	</div>
	<div id="content"><div class="bd clx">
		
<?php 
}
 function mfthemes_zhuanti_content() { 
	$options = get_option('mfthemes_options');
	$filmstrip = $options['filmstrip_zhuanti'];
	$cnt = count($filmstrip['src']);
	if( ($filmstrip['src'][0]!="" || $filmstrip['src'][1]!="" || $filmstrip['src'][2]!="") && $cnt>0){
		for($i=0;$i<$cnt;$i++){
			//var_dump($src);
			$src = $filmstrip["src"][$i];
			$t = $filmstrip["title"][$i];
			$href = $filmstrip["href"][$i];
			if($src!=""){
				$file_src = mfthemes_thumb($src,246, 70, 1);
				$film .= "<li class=\"p-item\"><a href=\"$href\" title=\"$t\" class=\"img-outer\" target=\"_blank\"><img alt=\"$t\" width=\"246\" height=\"70\" class=\"img\" src=\"$file_src\"></a><div class=\"t\"><a href=\"$href\" target=\"_blank\">$t</a></div></li>";
			}
		}
	

?>			
	<div class="bx-sya pitch">
			<div class="hd"><h2 class="h">精彩专题</h2></div>
			<div class="bd">
<ul class="topic-sya">
					  <?php echo $film;?>
	            			</ul>
							</div>
		</div>
	<?php }
}
 
function mfthemes_before_content() { 
	$options = get_option('mfthemes_options');
	$filmstrip = $options['filmstrip'];
	$cnt = count($filmstrip['src']);
	if( ($filmstrip['src'][0]!="" || $filmstrip['src'][1]!="" || $filmstrip['src'][2]!="" || $filmstrip['src'][3]!="" || $filmstrip['src'][4]!="" || $filmstrip['src'][5]!="" || $filmstrip['src'][6]!="" || $filmstrip['src'][7]!="" || $filmstrip['src'][8]!="" || $filmstrip['src'][9]!="") && $cnt>0){
		for($i=0;$i<$cnt;$i++){
			//var_dump($src);
			$src = $filmstrip["src"][$i];
			$t = $filmstrip["title"][$i];
			$href = $filmstrip["href"][$i];
			if($src!=""){
				$file_src = mfthemes_thumb($src,1440, 390, 1);
				$film .= "<li class=\"item\" style=\"background-color: rgb(0, 0, 0); background-image: url($file_src); display: none; opacity: 1;\"><a class=\"focus-link\" href=\"$href\" width=\"1440\" height=\"390\" target=\"_blank\" ></a></li>";
				$title .= "<li><a href=\"$href\">$t</a></li>";
				$timthumb = mfthemes_thumb($src,102,48,1);
				$nav .= "<li class=\"item select\"><img width=\"102\" height=\"48\" src=\"$timthumb\" class=\"thumb\" title=\"$t\"><a class=\"thumb-link\" href=\"$href\" title=\"$t\"></a></li>";
			}
		}
		
	?>
		<div class="focus-sya">
 <div class="focus-inner">
     <ul class="focus-panel">
     <?php echo $film;?>
	 </ul>    
         
  <div class="focus-control">
   <div class="focus-nav">
    <ul class="focus-tab" style="left: 0px;">
	       	    <?php echo $nav;?> 
				 </ul>
   </div>
   <a title="向左" href="javascript:" class="pre-btn"><span class="s">向左</span></a>
   <a title="向右" href="javascript:" class="next-btn"><span class="s">向右</span></a>
  </div>
 <div class="loading-sya" style="display: none;"><b class="ico ico-loading-sya"></b>加载中...</div></div>
</div>	

	<?php }
}
/**
 * LoveVideo Actions
 * Hooks into various actions in the theme.
 *
 *
 * @version 1.0
 * @author 东少
 * @package LoveVideo
 * @copyright 2014 all rights reserved
 *
 */
function mfthemes_footer() { ?>
	</div></div>
	<div id="footer">
		<div class="bd clx">
			<?php $options = get_option('mfthemes_options');
			if( $options['footer']){?>
				<?php echo $options['footer'];?>
			<?php }else{?>
				<p>&copy; <?php echo date("Y");?> <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> All Rights Reserved! </p>
				<p>Powered By WordPress, Theme By <a href="http://www.dz9.net/" title="多姿-关注互联网">多姿</a></p>
			<?php }?>
		</div>
	</div><!--footer-->
	<a id="goback" href="#heaader"><em></em><?php _e("back to top", "LoveVideo");?></a><!--goback-->
	<?php $options = get_option('mfthemes_options');
	if( $options['analysis']){?>
	<div id="analysis"><?php echo $options['analysis'];?></div>
	<?php }?>
<?php 
}
?>