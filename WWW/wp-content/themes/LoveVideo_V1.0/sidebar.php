<div id="sidebar">
	<?php if( is_home() || is_search() || is_archive() || is_page('views')  || is_page('video') || is_page('image') ){?>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar1') ) :?>
			<p><?php _e('Please go to the add background small tools', 'LoveVideo');?></p>
		<?php endif;?>
		<div id="sidebar-fixed">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar1fixed') ) :?><?php endif;?>
		</div>
	<?php }else{?>
	
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar2') ) :?>
			<p><?php _e('Please go to the add background small tools', 'LoveVideo');?></p>
		<?php endif;?>
		<div id="sidebar-fixed">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar2fixed') ) :?><?php endif;?>
		</div>
	<?php }?>
</div>
</div><!-- end #single-->