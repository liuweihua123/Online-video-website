<?php
/**
 * LoveVideo Actions
 * Hooks into various actions in the theme.
 *
 *
 * @version 1.0
 * @author ¶«ÉÙ
 * @package LoveVideo
 * @copyright 2014 all rights reserved
 *
 */
function mfthemes_meta() {global $pagenow;?>
	<?php if ($pagenow == "wp-login.php") { 
		if (isset($_GET['action'])) $action = $_GET['action']; else $action='';
        switch($action) :
            case 'lostpassword':
                $title = __('Retrieve your lost password for ','LoveVideo').get_bloginfo('name');
            break;
            case 'register':
                $title = __('Register at ','LoveVideo').get_bloginfo('name');
            break;
			case 'login':
            default:
                $title = __('Login at ','LoveVideo').get_bloginfo('name');
            break;
        endswitch;
	?><title><?php echo $title; ?></title>
	<?php }elseif($pagenow == "profile.php"){ 
			$title = __('Your Profile at ','LoveVideo').get_bloginfo('name');
		?>
<title><?php echo $title; ?></title>
	<?php } ?>
	<?php if ( is_home() ) { ?><title><?php bloginfo('name'); ?>&#160;&#45;&#160;<?php bloginfo('description'); ?></title><?php } ?>
	<?php if ( is_search() ) { ?><title><?php _e('Search&#160;&#34;','LoveVideo');echo $_GET['s'];echo "&#34;";?>&#160;&#45;&#160;<?php bloginfo('name'); ?></title><?php } ?>
	<?php if ( is_single() ) { ?><title><?php echo trim(wp_title('',0)); ?>&#160;&#45;&#160;<?php bloginfo('description'); ?></title><?php } ?>
	<?php if ( is_author() ) { ?><title><?php wp_title(""); ?>&#160;&#45;&#160;<?php bloginfo('name'); ?></title><?php } ?>
	<?php if ( is_archive() ) { ?><title><?php single_cat_title(); ?>&#160;&#45;&#160;<?php bloginfo('name'); ?></title><?php } ?>
	<?php if ( is_year() ) { ?><title><?php the_time('Y'); ?>&#160;&#45;&#160;<?php bloginfo('name'); ?></title><?php } ?>
	<?php if ( is_month() ) { ?><title><?php the_time('F'); ?>&#160;&#45;&#160;<?php bloginfo('name'); ?></title><?php } ?>
    <?php if ( is_page() ) { ?>
	<?php }else{ ?>
    <title><?php echo trim(wp_title('',0)); ?><?php bloginfo('name'); ?>&#160;&#45;&#160;<?php bloginfo('description'); ?></title>
    <?php } ?>
    <?php if ( is_404() ) { ?><title>404&#160;&#45;&#160;<?php bloginfo('name'); ?></title><?php } ?>
<?php
	$options = get_option('mfthemes_options'); 
	global $post;
	if (is_home()){
		$keywords = $options['keywords'];
		$description = $options['description'];
	}elseif (is_single()){
		$keywords = get_post_meta($post->ID, "keywords", true);
		if($keywords == ""){
			$tags = wp_get_post_tags($post->ID);
			foreach ($tags as $tag){
				$keywords = $keywords.$tag->name.",";
			}
			$keywords = rtrim($keywords, ', ');
		}
		$description = get_post_meta($post->ID, "description", true);
		if($description == ""){
			if($post->post_excerpt){
				$description = $post->post_excerpt;
			}else{
				$description = mb_strimwidth(strip_tags($post->post_content),0,200,'');
			}
		}
	}elseif (is_page()){
		$keywords = $options['keywords'];
		$description = $options['description'];
	}elseif (is_category()){
		$keywords = single_cat_title('', false);
		$description = category_description();
	}elseif (is_tag()){
		$keywords = single_tag_title('', false);
		$description = tag_description();
	}
	$keywords = trim(strip_tags($keywords));
	$description = trim(strip_tags($description));
	?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<meta name="description" content="<?php echo $description; ?>" />
<?php $favicon =  $options['favicon'] ? $options['favicon'] : get_bloginfo('url')."/favicon.ico" ;?>
<link rel="shortcut icon" href="<?php echo $favicon;?>" type="image/x-icon" />
<?php 
}

?>