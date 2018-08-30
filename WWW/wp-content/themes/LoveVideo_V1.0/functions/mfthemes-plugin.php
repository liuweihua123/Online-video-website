<?php
/**
 * LoveVideo core theme functions
 *
 *
 * @package LoveVideo
 * @author 东少
 * @url http://www.dz9.net
 */

add_action( 'after_setup_theme', 'mfthemes_init' ); 
function mfthemes_init(){
	
	
	// If path not exist, just create a new one
	$thumb_path = ABSPATH . "wp-content/uploads/thumbnail/";
	if (file_exists ($thumb_path)) {
		if (! is_writeable ( $thumb_path )) {
			chmod ( $thumb_path, '511' );
		}
	} else {
		mkdir ( $thumb_path, '511', true );
	}
	
	// If path not exist, just create a new one
	$thumb_path2 = ABSPATH . "wp-content/uploads/thumbnail/avatar/";
	if (file_exists ($thumb_path2)) {
		if (! is_writeable ( $thumb_path2 )) {
			chmod ( $thumb_path2, '511' );
		}
	} else {
		mkdir ( $thumb_path2, '511', true );
	}
}


function mfthemes_check(){
	$posts = get_posts('numberposts=-1');
	$cnt = count($posts);
	$haveImg = array();
	$noWidth = array();
	$disment = array();
	foreach( $posts as $post ):
		$output = preg_match('/\<img.+?src="(.+?)".*?\/>/is',$post->post_content,$match);
		if(count($match) > 0){
			$format = get_post_format($post->ID);
			
			if( $format!="image" && $format!="video" ){
				array_push($haveImg, $post->ID);
			}
			$m = $match[0];
			preg_match('/width=\"\d{1,5}\"/i',$m,$w);
			preg_match('/height=\"\d{1,5}\"/i',$m,$h);
			if( !count($w) || !count( $h) ) array_push($noWidth, $post->ID);
			
		}
	endforeach;
	$disment = array(
		"format" => $haveImg,
		"size" => $noWidth
	);
	return $disment;
}

add_action('init', 'mfthemes_carding');
function mfthemes_carding(){
	if( isset($_POST['carding']) ){
		if($_POST['carding'] == 'carding_post'){
			$post_id = $_POST['id'];
			if( isset($_POST['src']) && $_POST['src'] ){
				
				$post = get_post( $post_id ); 
				$content = $post->post_content;
				
				$w = $_POST['width'];
				$h = $_POST['height'];
				
				$oldStr = $_POST['src'].'"';
				$newStr = $_POST['src'].'" width="'.$w.'" height="'.$h.'"';
				
				$my_post = array();
				$my_post['ID'] = $post_id;
				$my_post['post_content'] = str_replace($oldStr, $newStr, $content);

				// Update the post into the database
				wp_update_post( $my_post );				
			}
			if( isset($_POST['format']) && $_POST['format'] ){
				set_post_format($post_id, 'image');
			}
		}else{echo 'failure';die();}
		echo 'success';
		die();
	}else{return;}
}

/**
 *  Ads for the index_main
 */
function mfthemes_main_ad(){
	$options = get_option('mfthemes_options');
	if( $options['admain']){?>
			<?php echo $options['admain'];?>
	<?php }
}

/**
 *  Ads for the index_paihang
 */
function mfthemes_paihang_ad(){
	$options = get_option('mfthemes_options');
	if( $options['adpaihang']){?>
			<?php echo $options['adpaihang'];?>
	<?php }
}

/**
 *  Ads for the player_menu
 */
function mfthemes_player_menu_ad(){
	$options = get_option('mfthemes_options');
	if( $options['adplayer_menu']){?>
			<?php echo $options['adplayer_menu'];?>
	<?php }
}

/**
 *  Ads for the player_button
 */
function mfthemes_player_button_ad(){
	$options = get_option('mfthemes_options');
	if( $options['adplayer']){?>
			<?php echo $options['adplayer'];?>
	<?php }
}
/**
 *  Ads for the single.php content
 */
function mfthemes_content_ad(){
	$options = get_option('mfthemes_options');
	if( $options['adcontent']){?>
			<?php echo $options['adcontent'];?>
	<?php }
}

 
function mfthemes_filename($a){
	$info = pathinfo($a);
	return $info["filename"];
}

function mfthemes_thumb_exist($img){
	return @file_exists($img) ? true : false;
}

function mfthemes_thumb($src, $width=null, $height=null, $crop = false, $index=false, $postid=null){
	$filename = mfthemes_filename($src);
	$new_name = $index ? $filename . '_'. $height .'.jpg' : $filename . '_'.$width.'.jpg';
	$new_name = $postid ? $postid . '_'. $new_name : $new_name;
	$new_src = "wp-content/uploads/thumbnail/".$new_name;
	
	if ( mfthemes_thumb_exist(ABSPATH.$new_src) ) {
		return home_url("/").$new_src;
	}else{
		$image = wp_get_image_editor( $src );
		if ( !is_wp_error( $image ) ) {
			$image->set_quality( 100 );
			$image->resize($width, $height, $crop);
			$image->save( $new_src );
			$image = null;
			return home_url("/").$new_src;
		}
	}
}

function mfthemes_avatar_thumb($src, $width=null, $name){
	$new_name = $name.'_'.$width.'.jpg';
	$new_src = "wp-content/uploads/thumbnail/avatar/".$new_name;
	
	if ( mfthemes_thumb_exist(ABSPATH.$new_src) ) {
		return home_url("/").$new_src;
	}else{
		$image = wp_get_image_editor( $src );
		if ( !is_wp_error( $image ) ) {
			$image->set_quality( 100 );
			$image->resize($width, $width, 1);
			$image->save( $new_src );
			$image = null;
			return home_url("/").$new_src;
		}
	}
}

/*
* Image thumbnail function
*/
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 200, 150, true );
function image_thumbnail(){
	global $post;
	$link = get_permalink($post->ID);
	$title = $post->post_title ? $post->post_title : __('no title', 'LoveVideo');
	$width = 200;
	$height = 150;
	$post_img = '';
	$options = get_option('mfthemes_options');
	$layout = $options["layout"];
	$postid = $options["postid"];
	if( has_post_thumbnail() ){
        $timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
		$post_img_150 = $postid ? mfthemes_thumb($timthumb_src[0], 200, 150, 1, 1, $post->ID) : mfthemes_thumb($timthumb_src[0], 200, 150, 1, 1);
		$post_img_200 = $postid ? mfthemes_thumb($timthumb_src[0], 200, null, 0, 0, $post->ID) : mfthemes_thumb($timthumb_src[0], 200);
		$post_img_src = $layout ? $post_img_200 : $post_img_150;
        $post_img = '<img src="'.get_bloginfo("template_url").'/assets/images/grey.jpg" original="'.$post_img_src.'" alt="'.$post->post_title.'" width="200" height="150" />';
        ?>
			<a href="<?php echo $link;?>" class="imageLink image loading" target="_blank"><?php echo $post_img;?><span class="bg"><?php echo $title;?></span></a>
		<?php
	}else{
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/\<img.*?src\=\"(.*?)\".*?width\=\"(.*?)\".*?height\=\"(.*?)\"[^>]*>/i',$post->post_content,$matches ,PREG_SET_ORDER);
		$cnt = count( $matches );
		if($cnt>0){
			$post_img_150 = $postid ? mfthemes_thumb($matches[0][1], 200, 150, 1, 1, $post->ID) : mfthemes_thumb($matches[0][1], 200, 150, 1, 1);
			$post_img_200 = $postid ? mfthemes_thumb($matches[0][1], 200, null, 0, 0, $post->ID) : mfthemes_thumb($matches[0][1], 200);			
			$post_img_src = $layout ? $post_img_200 : $post_img_150;
			
			//var_dump($post_img_150);
			
			$width = $matches[0][2];
			$height0 = $matches[0][3];
			$height = $height0 * 200 / $width;
			$post_gray = get_bloginfo("template_url").'/assets/images/grey.jpg';
			$post_img = "<a href='$link' class='imageLink image loading' target='_blank'><img src='$post_gray' original='$post_img_src' width='200' height='150' alt='$title' title='$post->post_title' oriheight='$height' /><span class='bg'>$title</span></a>";	
			?>
				<?php echo $post_img;?>
			<?php
		}
	}
}

/*
* Video thumbnail function
*/
function video_thumbnail(){
	global $post;
	$link = get_permalink($post->ID);
	$title = $post->post_title ? $post->post_title : __('no title', 'LoveVideo');
	$content = $post->post_content;
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/\<img.+?class="youku-pic".+?src=".+?".*?\/>/is',$content,$matches ,PREG_SET_ORDER);
	$cnt = count( $matches );
	if($cnt>0){
		$post_img = $matches[0][0];
		$post_gray = get_bloginfo("template_url").'/assets/images/grey.jpg';
		$replace = "src='$post_gray' original=";
		$post_img = str_replace("src=", $replace, $post_img);
		?>
			<a href="<?php echo $link;?>" class="imageLink loading video" title="<?php echo $title;?>" target="_blank"><?php echo $post_img;?><span class="play"></span><span class="bg"><?php echo $title;?></span></a>
		<?php
	}
}


/*
* Video thumbnail function
*/
function video_edit_img($content){
	$output = preg_match_all('/\<img.+?class="youku-pic".+?src=".+?".*?\/>/is',$content,$matches ,PREG_SET_ORDER);
	$cnt = count( $matches );
	if($cnt>0){
		$post_img = $matches[0][0];
		return $post_img;
	}
}


/*
* Video thumbnail function
*/
function video_edit_obj($content){
	$output = preg_match_all('/\<img.+?class="youku-pic".+?\/embed>/is',$content,$matches ,PREG_SET_ORDER);
	$cnt = count( $matches );
	if($cnt>0){
		return $matches[0][0];
	}
}


/*
* image thumbnail function
*/
function image_edit_img($content){
	global $post;
	$options = get_option('mfthemes_options');
	$postid = $options["postid"];
	$output = preg_match_all("/\<img.*?src\=\"(.*?)\".*?width\=\"(.*?)\".*?height\=\"(.*?)\"[^>]*>/i",$content,$matches ,PREG_SET_ORDER);
	$cnt = count( $matches );
	if($cnt>0){
		for($k=0;$k<$cnt;$k++){
			$post_img_src = $postid ? mfthemes_thumb($matches[$k][1], 70, 70, 1, 0, $post->ID) : mfthemes_thumb($matches[$k][1], 70, 70, 1);
			echo '<div class="img" rs="' . $matches[$k][1] . '" rw="' . $matches[$k][2] .'" rh="'. $matches[$k][3] . '" style="background:url('.$post_img_src . ') no-repeat;"></div>';
		}
	}
}

/*
* image thumbnail function
*/
function image_edit_obj($content){
	$output = preg_match_all('/\<img.+?src="(.+?)".*?\/>/is',$content,$matches ,PREG_SET_ORDER);
	$cnt = count( $matches );
	$obj="";
	if($cnt>0){
		for($i=0;$i<$cnt;$i++){
			$obj.= $matches[$i][0];
		}
		return $obj;
	}
}


/*
* Post sidebar video thumbnail function
*/
function video_sidebar_thumbnail(){
	global $post;
	$link = get_permalink($post->ID);
	$title = $post->post_title ? $post->post_title : __('no title', 'LoveVideo');
	$content = $post->post_content;
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/\<img.+?class="youku-pic".+?src=".+?".*?\/>/is',$content,$matches ,PREG_SET_ORDER);
	$cnt = count( $matches );
	if($cnt>0){
		$post_img = $matches[0][0];
		?>
			<a href="<?php echo $link;?>" class="imageLink loading" title="<?php echo $title;?>" target="_blank"><?php echo $post_img;?><span class="play"></span></a>
		<?php
	}
}

/*
* Post sidebar thumbnail function
*/
function post_sidebar_thumbnail($w=70, $echo=true, $lazyload = false){
	global $post;
	$post_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/\<img.+?src="(.+?)".*?\/>/is',$post->post_content,$matches ,PREG_SET_ORDER);
	$cnt = count( $matches );
	$options = get_option('mfthemes_options');
	$postid = $options["postid"];
	if($cnt>0){
		$post_img_src = $postid ? mfthemes_thumb($matches[0][1], $w, $w, 1, 0, $post->ID) : mfthemes_thumb($matches[0][1], $w, $w, 1);
		$post_img = '<img src="'.$post_img_src.'" wdith="'.$w.'" height="'.$w.'" />';
		
	}else{
		$options = get_option('mfthemes_options');
		$thumb = $options['thumb']!="" ? $options['thumb'] : get_bloginfo("template_url").'/assets/images/thumb.jpg';
		$post_img_src = $postid ? mfthemes_thumb($thumb, $w, $w, 1, 0, $post->ID) : mfthemes_thumb($thumb, $w, $w, 1);
		$post_img = "<img src='$post_img_src' wdith='$w' height='$w' />";		
	}
	$post_img = "<img src=\"$post_img_src\" wdith=\"$w\" height=\"$w\" />";	
	if($lazyload){
		$post_gray = get_bloginfo("template_url").'/assets/images/grey.jpg';
		$post_img = "<img src=\"$post_gray\" original=\"$post_img_src\" wdith=\"$w\" height=\"$w\" />";
	}	
	if($echo) {
		echo $post_img;
	}else{
		return $post_img;
	}
}

/*
* Author thumbnail function
*/
function author_thumbnail($w=70){
	global $post;
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/\<img.+?src="(.+?)".*?\/>/is',$post->post_content,$matches ,PREG_SET_ORDER);
	$cnt = count( $matches );
	if($cnt>0){
		$cnt = $cnt > 10 ? 10 : $cnt;
		for($i=0; $i<$cnt; $i++){
			$img = $matches[$i][1];
			$post_img_src = mfthemes_thumb($img, $w, $w, 1);
			echo "<img class='thumbnail-$i' src='$post_img_src' height='$w' alt='$title'/>";
		}
	}
}

add_action('init', 'mfthemes_image_upload_thumb');
function mfthemes_image_upload_thumb(){
	if( isset($_GET['ajax_src']) && $_GET['ajax_src'] ){
		$src = $_GET['ajax_src'];
		$w = $_GET['w'];
		$h = $_GET['h'];
		$zc = $_GET['zc'];
		$filename = mfthemes_filename($src);
		$new_name = $filename . '_'.$w.'.jpg';
		$new_src = "wp-content/uploads/thumbnail/".$new_name;
		
		if ( mfthemes_thumb_exist(ABSPATH.$new_src) ) {
			$image = wp_get_image_editor( home_url("/").$new_src );
			if ( !is_wp_error( $image ) ) {
				$image->stream();
				$image = null;
			}
		}else{
			$image = wp_get_image_editor( $src );
			if ( !is_wp_error( $image ) ) {
				$image->set_quality( 100 );
				$image->resize($w, $h, $zc);
				$image->save( $new_src );
				$image->stream();
				$image = null;
			}
			//return home_url("/").$new_src;
		}
		die();
	}else{return;}
}

/*
* Best Image thumbnail function
*/
function image_thumbnail_best(){
	global $post;
	$link = get_permalink($post->ID);
	$title = $post->post_title ? $post->post_title : __('no title', 'LoveVideo');
	$width = 200;
	$height = 150;
	$post_img = '';
	$options = get_option('mfthemes_options');
	$layout = $options["layout"];
	$postid = $options["postid"];
	if( has_post_thumbnail() ){
        $timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
		$post_img_150 = $postid ? mfthemes_thumb($timthumb_src[0], 200, 150, 1, 1, $post->ID) : mfthemes_thumb($timthumb_src[0], 200, 150, 1, 1);
		$post_img_src = $layout ? $post_img_150 : $post_img_150;
        $post_img = '<img src="/wp-content/themes/Love/assets/images/grey.jpg" original="'.$post_img_src.'" alt="'.$post->post_title.'" width="200" height="150" />';
        ?>
			<a href="<?php echo $link;?>" class="imageLink image loading" target="_blank"><?php echo $post_img;?><span class="bg"><?php echo $title;?></span></a>
		<?php
	}else{
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/\<img.*?src\=\"(.*?)\".*?width\=\"(.*?)\".*?height\=\"(.*?)\"[^>]*>/i',$post->post_content,$matches ,PREG_SET_ORDER);
		$cnt = count( $matches );
		if($cnt>0){
			$post_img_150 = $postid ? mfthemes_thumb($matches[0][1], 200, 150, 1, 1, $post->ID) : mfthemes_thumb($matches[0][1], 200, 150, 1, 1);		
			$post_img_src = $layout ? $post_img_150 : $post_img_150;
			
			//var_dump($post_img_150);
			
			$post_gray = '/wp-content/themes/Love/assets/images/grey.jpg';
			$post_img = "<a href='$link' class='imageLink image loading' target='_blank'><img src='$post_gray' original='$post_img_src' width='200' height='150' alt='$title' title='$post->post_title' oriheight='150' /><span class='bg'>$title</span></a>";	
			?>
				<?php echo $post_img;?>
			<?php
		}
	}
}

?>