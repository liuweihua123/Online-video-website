<?php

//////////////////////////////////////////////////////////

class mfthemes_widget1 extends WP_Widget {
    function mfthemes_widget1() {
        $widget_ops = array('description' => __('Similar images', 'LoveVideo'));
        $this->WP_Widget('mfthemes_widget1','L-'.__('Similar images', 'LoveVideo'), $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
		$title = $instance['title'] ? strip_tags($instance['title']) : __('Similar images', 'LoveVideo');
        $limit = strip_tags($instance['limit']);
?>
	<div class="widgets">
			<h3><?php echo $title;?></h3>
			<ul class="widgets-similar clx">
				<?php
				$post_num = $limit ? $limit : 12;
				$exclude_id = $post->ID;
				$posttags = get_the_tags(); $i = 0;
				if ( $posttags ) {
					$tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->term_id . ',';
					$args = array('post_status' => 'publish', 'tag__in' => explode(',', $tags), 'post__not_in' => explode(',', $exclude_id), 'ignore_sticky_posts' => 1, 'orderby' => 'rand', 'posts_per_page' => $post_num);
					query_posts($args);
					while( have_posts() ) { the_post(); $class = ($i+1)%3==0 ? 'class="similar similar-third"':'class="similar"';?>
						<li <?php echo $class;?>>
							<a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php post_sidebar_thumbnail(70); ?></a>
						</li>
					<?php
						$exclude_id .= ',' . $post->ID; $i ++;
					} wp_reset_query();
				}
				if ( $i < $post_num ) {
					$cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
					$args = array('category__in' => explode(',', $cats), 'post__not_in' => explode(',', $exclude_id), 'ignore_sticky_posts' => 1, 'orderby' => 'rand', 'posts_per_page' => $post_num - $i); query_posts($args);
					while( have_posts() ) { the_post();  $class = ($i+1)%3==0 ? 'class="similar similar-third"':'class="similar"';?>
						<li <?php echo $class;?>>
							<a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php post_sidebar_thumbnail(70); ?></a>
						</li>
				 
					<?php $i++;
					} wp_reset_query();
				}
				if ( $i  == 0 ) _e('no similar posts', 'LoveVideo');
				?>
			</ul>
	</div>
<?php	
    }
	
    function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['limit'] = strip_tags($new_instance['limit']);
		 $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('limit' => ''), array('title' => ''));
        $limit = strip_tags($instance['limit']);
		$title = strip_tags($instance['title']);
?>
        
         <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('widget title&#58;', 'LoveVideo');?><input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Post number&#58;', 'LoveVideo');?><input id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label></p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php
    }
}
add_action('widgets_init', 'mfthemes_widget1_init');
function mfthemes_widget1_init() {
    register_widget('mfthemes_widget1');
}

//////////////////////////////////////////////////////////

class mfthemes_widget2 extends WP_Widget {
    function mfthemes_widget2() {
        $widget_ops = array('description' => __('popular tags', 'LoveVideo'));
        $this->WP_Widget('mfthemes_widget2','L-'.__('popular tags', 'LoveVideo'), $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $limit = strip_tags($instance['limit']);
		$limit = $limit ? $limit : 30;
		$title = $instance['title'] ? strip_tags($instance['title']) : __('popular tags', 'LoveVideo');
?>
	<div class="widgets">
		<h3><?php echo $title;?></h3>
		<div id="pin-tags" class="clx">
			<?php wp_tag_cloud("smallest=10&largest=10&orderby=count&order=DESC&number=$limit"); ?>
		</div>
	</div>
<?php	
    }
	
    function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['limit'] = strip_tags($new_instance['limit']);
		$instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('limit' => ''));
        $limit = strip_tags($instance['limit']);
		$title = strip_tags($instance['title']);
?>
         <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('widget title&#58;', 'LoveVideo');?><input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>       
        <p><label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Post number&#58;', 'LoveVideo');?><input id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label></p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php
    }
}
add_action('widgets_init', 'mfthemes_widget2_init');
function mfthemes_widget2_init() {
    register_widget('mfthemes_widget2');
}

//////////////////////////////////////////////////////////

class mfthemes_widget3 extends WP_Widget {
    function mfthemes_widget3() {
        $widget_ops = array('description' => __('Add for sidebar', 'LoveVideo'));
        $this->WP_Widget('mfthemes_widget3','L-'.__('Add for sidebar', 'LoveVideo'), $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $html = $instance['html'];
		$title = $instance['title'];
?>
	<div class="widgets">
		<h3><?php echo $title;?></h3>
		<div class="widgets-as"><?php echo $html;?></div>
	</div>
<?php	
    }
	
    function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['html'] = $new_instance['html'];
		$instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('html' => ''), array('title'=> ''));
        $html = $instance['html'];
		$title = strip_tags($instance['title']);
?>
          <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('widget title&#58;', 'LoveVideo');?><input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>       
        <p><label for="<?php echo $this->get_field_id('html'); ?>"><?php _e('Ad html code&#58;', 'LoveVideo');?><br /><textarea id="<?php echo $this->get_field_id('html'); ?>" name="<?php echo $this->get_field_name('html'); ?>" class="widefat" type="text"><?php echo $html; ?></textarea></label></p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php
    }
}
add_action('widgets_init', 'mfthemes_widget3_init');
function mfthemes_widget3_init() {
    register_widget('mfthemes_widget3');
}

//////////////////////////////////////////////////////////

class mfthemes_widget4 extends WP_Widget {
    function mfthemes_widget4() {
        $widget_ops = array('description' => __('Most popular images', 'LoveVideo'));
        $this->WP_Widget('mfthemes_widget4','L-'.__('Most popular images', 'LoveVideo'), $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $limit = strip_tags($instance['limit']);
		$limit = $limit ? $limit : 12;
		$title = $instance['title'] ? strip_tags($instance['title']) : __('Most popular images', 'LoveVideo');
?>
	<div class="widgets">
			<h3><?php echo $title;?></h3>
			<ul class="widgets-popular widgets-similar clx">
				<?php
					$j=0;
					$paged = 1;
					$args2 = array(
						'meta_key' => 'views',
						'orderby'   => 'meta_value_num',
						'showposts'=> $limit,
						'paged' => $paged,
						'ignore_sticky_posts' => 1,
						'order' => DESC
					);
					query_posts($args2);
					while( have_posts() ) { the_post();  $class = ($j+1)%3==0 ? 'class="similar similar-third"':'class="similar"';?>
						<li <?php echo $class;?>>
							<a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php post_sidebar_thumbnail(70); ?></a>
						</li>
				 
					<?php $j++;
					} wp_reset_query();
				?>
			</ul>
	</div>
<?php	
    }
	
    function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['limit'] = strip_tags($new_instance['limit']);
		$instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('limit' => ''));
        $limit = strip_tags($instance['limit']);
		$title = strip_tags($instance['title']);
?>
         <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('widget title&#58;', 'LoveVideo');?><input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>      
        <p><label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Post number&#58;', 'LoveVideo');?><input id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label></p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php
    }
}
add_action('widgets_init', 'mfthemes_widget4_init');
function mfthemes_widget4_init() {
    register_widget('mfthemes_widget4');
}

//////////////////////////////////////////////////////////
class mfthemes_widget6 extends WP_Widget {
    function mfthemes_widget6() {
        $widget_ops = array('description' => __('Author info', 'LoveVideo'));
        $this->WP_Widget('mfthemes_widget6','L-'.__('Author info', 'LoveVideo'), $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
		$title = $instance['title'] ? strip_tags($instance['title']) : __('Author info', 'LoveVideo');
        $limit = strip_tags($instance['limit']);
?>
	
		<?php if( is_home() || is_search() || is_archive() || is_page('views')  || is_page('video') || is_page('image')){?>
			<div class="widgets">
			<?php if ( is_user_logged_in() ) {
				global $current_user;
				get_currentuserinfo(); 
				?>
				
				<div class="widget-author clx">
					<?php echo get_avatar( $current_user->ID , 40 ); ?>
					<div class="main-desp">
						<h4><?php echo $current_user->display_name; ?></h4>
						<p><?php echo $current_user->user_description; ?></p>
					</div>
				</div>
				<?php if( $current_user->user_level>0 ) {?>
				<div class="author-option clx">
					<div class="gap">
						<a href="<?php echo get_page_link_by_title('profile');?>"><span><?php _e('Edit my profile', 'LoveVideo');?></span></a>
					</div>
					<a href="<?php new_link('text');?>"><?php _e('New text','LoveVideo'); ?></a>
					<a href="<?php new_link('image');?>"><?php _e('New image','LoveVideo'); ?></a>
					<a href="<?php new_link('video');?>"><?php _e('New video','LoveVideo'); ?></a>
				</div>
				<?php }?>			
			<?php }else{?>
				<h3><?php _e('Login now','LoveVideo'); ?></h3>
				<div class="widget-login clx">
					<a href="<?php bloginfo('url'); ?>/wp-login.php" class="loginin" title="<?php _e("login in", "LoveVideo");?>"><?php _e("login in", "LoveVideo");?></a>
					<a href="<?php bloginfo('url'); ?>/wp-login.php?action=register" class="signup" title="<?php _e("sign up", "LoveVideo");?>"><?php _e("sign up", "LoveVideo");?></a>
				</div>
			<?php }?>
			</div>
		<?php }else if(is_single()){?>
			<div class="widgets">
				<div class="widget-author clx">
					<?php echo get_avatar( get_the_author_id() , 40 ); ?>
					<div class="main-desp">
						<h4><?php _e('Author&#58', 'LoveVideo');?><?php the_author_posts_link(); ?></h4>
						<p><?php echo get_the_author_meta('user_description');?></p>
					</div>
				</div>
			</div>
		<?php }?>
	
<?php	
    }
	
    function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
		 $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('limit' => ''), array('title' => ''));
		$title = strip_tags($instance['title']);
?>
        
         <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('widget title&#58;', 'LoveVideo');?><input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php
    }
}
add_action('widgets_init', 'mfthemes_widget6_init');
function mfthemes_widget6_init() {
    register_widget('mfthemes_widget6');
}



//////////////////////////////////////////////////////////
class mfthemes_widget8 extends WP_Widget {
    function mfthemes_widget8() {
        $widget_ops = array('description' => __('SNS', 'LoveVideo'));
        $this->WP_Widget('mfthemes_widget8','L-'.__('SNS', 'LoveVideo'), $widget_ops);
    }
    function widget($args, $instance) {
		global $post;
        extract($args);
		$title = $instance['title'] ? strip_tags($instance['title']) : __('SNS', 'LoveVideo');

?>
	<div id="widgets-sns" class="widgets">
		<h3><?php echo $title;?></h3>
		<ul class="clx">
			<?php $array = array(
					"rss" => __("RSS", 'LoveVideo'), 
					"tsina"=>  __("tsina", 'LoveVideo'), 
					"tqq" => __("tqq", 'LoveVideo'), 
					"renren"=>  __("renren", 'LoveVideo'), 
					"douban" => __("douban", 'LoveVideo'), 
					"kaixin"=>  __("kaixin", 'LoveVideo'), 
					);
				$options = get_option('mfthemes_options');
				foreach($array as $value => $X){
					if($value=="rss") {?>
						<a href="<?php if($options['rss']!=""){echo $options['rss'];}else{bloginfo('rss2_url');} ?>" class="sns-rss" title="<?php _e('RSS','LoveVideo');?>"></a>
					<?php }else if($options[$value]){?>
						<a href="<?php echo $options[$value];?>" class="sns-<?php echo $value;?>" title="<?php echo $X;?>"></a>
					<?php }
				}
			?>
		</ul>
	</div>
<?php	
    }
	
    function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
		 $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('limit' => ''), array('title' => ''));
		$title = strip_tags($instance['title']);
?>
        
         <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('widget title&#58;', 'LoveVideo');?><input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php
    }
}
add_action('widgets_init', 'mfthemes_widget8_init');
function mfthemes_widget8_init() {
    register_widget('mfthemes_widget8');
}



//////////////////////////////////////////////////////////
class mfthemes_widget9 extends WP_Widget {
    function mfthemes_widget9() {
        $widget_ops = array('description' => __('Search', 'LoveVideo'));
        $this->WP_Widget('mfthemes_widget9','L-'.__('Search', 'LoveVideo'), $widget_ops);
    }
    function widget($args, $instance) {
		global $post;
        extract($args);
		$title = $instance['title'] ? strip_tags($instance['title']) : __('Search', 'LoveVideo');

?>
	<div id="widgets-sns" class="widgets">
		<h3><?php echo $title;?></h3>
		<div id="search" class="clearfix">
			<form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
				<input type="text" class="search-input" name="s" id="s" placeholder="<?php _e('Search', 'LoveVideo');?>">
				<input type="submit" class="search-submit" value="<?php _e('Search', 'LoveVideo');?>">
			</form>
		</div>		
	</div>
<?php	
    }
	
    function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
		 $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('limit' => ''), array('title' => ''));
		$title = strip_tags($instance['title']);
?>
        
         <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('widget title&#58;', 'LoveVideo');?><input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php
    }
}
add_action('widgets_init', 'mfthemes_widget9_init');
function mfthemes_widget9_init() {
    register_widget('mfthemes_widget9');
}
?>